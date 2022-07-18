<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail;
use Session;
use Carbon\Carbon;

class employeeController extends Controller
{
    public function employee_Login(Request $request){
        $request->validate([
            "username"=>"required|regex:/^\S*$/u",
            "password"=>"required"
        ]);

        $q = DB::table('employee')
            ->where('username',$request->username)
            ->where('password',$request->password)->get();

        $cnt = count($q);

        $request->session()->put('employee_login_session',$q); 


        if($cnt == 1){
            $eid = Session::get('employee_login_session')[0]->eid;
            DB::table('employee')->where('eid',$eid)->update([
                "status2"=>1
            ]);
            $data = DB::table('admin')->select('company')->get();
            $request->session()->put('employee_login_session2',$data);
            
            return redirect('employee_dashboard')->with(compact('data'));
        }else{
            return back()->with("fail","Username or password are invalid");
        }

    }
    public function employee_logout()
    {
        if(session()->has('employee_login_session')){
            $eid = Session::get('employee_login_session')[0]->eid;
            DB::table('employee')->where('eid',$eid)->update([
                "status2"=>0
            ]);
            // session()->flush('employee_login_session');
            Session::forget('employee_login_session');

        }
        return redirect('employee');
    }
    public function employee_profile_data($id)
    {
        if(session()->has('employee_login_session')){
            $data = DB::table('employee')->where('eid',$id)->get();
            return view('employee.employee_profile', compact('data'));
        }else{
            return redirect('employee');
        }
    }

    public function employee_dashboard()
    {
        if(session()->has('employee_login_session')){
            $eid = Session::get('employee_login_session')[0]->eid;
            if(Session::get('employee_login_session')[0]->role == 1){
                $data['total_project'] = count(DB::table('project_assign')->where('eid',$eid)->get());
                $data['total_project_complete'] = count(DB::table('project_assign')
                                        ->where('eid',$eid)->where('status',3)->get());
                $data['total_project_pending'] = count(DB::table('project_assign')
                                        ->where('eid',$eid)->where('status',2)->orwhere('status',1)->get());
                $data['total_team'] = count(DB::table('team')
                                        ->where('manager',$eid)->get());
                
                $data['project_assign'] = DB::table('project_assign')->where('eid',$eid)->get();
                // $data['projects'] = DB::table('project')->orderBy('pid', 'desc')->take(5)->get();
                $data['projects'] = DB::select("select * from project where pid in (select pid from project_assign where eid = $eid) order by pid desc limit 5");
                // echo "<pre>"; print_r($data);
                
                return view('employee.dashboard',compact('data'));

            }elseif(Session::get('employee_login_session')[0]->role == 3) {
                $data['total_task'] = count(DB::table('task')->where('eid',$eid)->get());
                $data['total_task_complete'] =  count(DB::table('task')->where('eid',$eid)
                                            ->where('status',4)->get());
                // $data['total_task_pending'] =  count(DB::table('task')->where('eid',$eid)
                //     ->where('status',1)->orwhere('status',2)->orwhere('status',3)->get());

                $data['total_task_pending'] = count(DB::select("select tid from task where eid=$eid 
                    and (status=1 or status=2 or status=3)"));

                $data['total_member'] = count(DB::select("select tid from team_member where tid in (select tid from team_member where eid = $eid)"));
                $data['tasks'] = DB::table('task')->where('eid',$eid)->orderBy('tid', 'desc')
                                ->take(5)->get();
                // echo "<pre>"; print_r($data);
                return view('employee.dashboard',compact('data'));
            }
        }
        else{
            return redirect('employee');
        }
    }

    public function employee_profile_update(Request $request, $id){
        if(session()->has('employee_login_session')){
            $request->validate([
                "name"=>"required",
                "email"=>"required|email",
                "mobile"=>"required|min:10|numeric",
                "bdate"=>"required",
                "exp"=>"required|numeric",
                'description' => 'required|min:3|max:1000',
            ]);

            $dateOfBirth = $request->bdate;
            $age = Carbon::parse($dateOfBirth)->diff(Carbon::now())->y;
            
    // ***********************
            // $file = $request->file('img');
            // $destinationPath = 'img/admin'; 
            // $extension = $file->getClientOriginalExtension(); 
            // $fileName = rand(11111, 99999).'.'.$extension; 
            // $response_success = $file->move($destinationPath, $fileName); 

    // ***********************
            $update = DB::table('employee')->where('eid',$id)->update([
                "name"=>$request->name,
                "email"=>$request->email,
                "mobile"=>$request->mobile,
                "bdate"=>$request->bdate,
                "age"=>$age,
                "exp"=>$request->exp,
                "description"=>$request->description,
            ]);
    // ***********************
            if(session()->has('employee_login_session')){
                session()->flush('employee_login_session');
            }
            $q = DB::table('employee')->where('eid',$id)->get();
            $request->session()->put('employee_login_session',$q); 

    // ***********************
            if($update){
                return back()->with("success","Update Successfully...");;
            }else{
                return back()->with("fail","No Changes Are Apply !");;
            }
    // ***********************
        }
        else{
            return redirect('employee');
        }
    }

    public function employee_profile_img(Request $request, $id)
    {
        if(session()->has('employee_login_session')){
            $request->validate([
                "img"=>"required",
            ]);

            $file = $request->file('img');
            $destinationPath = 'img/employee'; 
            if($file->getClientOriginalExtension() == null){
                return back()->with("fail","No Changes Are Apply !");
            }
            $extension = $file->getClientOriginalExtension(); 
            $fileName = $id."_".rand(11111, 99999).'.'.$extension; 
            $response_success = $file->move($destinationPath, $fileName); 

            $update = DB::table('employee')->where('eid',$id)->update([
                 "img"=>$fileName,
            ]);

            if($update){
                return back()->with("success","Upload Successfully...");
            }else{
                return back()->with("fail","No Changes Are Apply !");
            }
        }else{
            return redirect('employee');
        }        
    }

    public function employee_change_password($id){
        if(session()->has('employee_login_session')){
            $q = DB::table('employee')->where('eid',$id)->get();
            
            $otp = rand(1000,9999);
            
            $update = DB::table('otp_tab')->update([
                'otp'=>$otp,
                'eid'=>$id
            ]);

            // -----------------------------------change password email sending start

            //$data = Session::get('admin_login_session');
 
            $data=['name'=>$q[0]->name,
                    'otp'=>$otp];


            $user['to'] = $q[0]->email;
            $m = Mail::send('change_pass_mail',$data,function($msg) use ($user){
                    $msg->to($user['to']);
                    $msg->subject('OTP For Change Password');
                });
            //-----------------------------------change password email sending end

            return redirect('employee_otp');

        }else{
            return redirect('employee');
        }
    }
    public function employee_otp()
    {
        if(session()->has('employee_login_session')){
            return view('employee.employee_otp');
        }else{
            return redirect('employee');
        }  
    }
    public function employee_otp_submit(Request $request)
    {
        if(session()->has('employee_login_session')){
            $request->validate([
                "otp"=>"required|min:4|max:4",
            ]);

            $data = DB::table('otp_tab')->get();
            if($request->otp == $data[0]->otp){
                return view('employee.employee_update_password',compact('data'));
            }else{
                return back()->with('fail','OTP Invalid');
            }
        }else{
            return redirect('employee');
        }   
    }
    public function employee_update_password(Request $request,$id)
    {
        if(session()->has('employee_login_session')){
            $request->validate([
                "password"=>"required",
                "cpassword"=>"required"
            ]);
            if($request->password == $request->cpassword){
                $update = DB::table('employee')->where('eid',$id)->update([
                    "password"=>$request->cpassword
                ]);
                if($update == 1){
                    return redirect('employee_logout');
                }else{
                    return back()->with('fail','Try Again !');    
                }
            }else{
                return back()->with('fail','Password Miss Match');
            }

        }else{
            return redirect('employee');
        }   
    }

    public function taskmanager_projects()
    {
        if(session()->has('employee_login_session')){
            $eid = Session::get('employee_login_session')[0]->eid;
            $data = DB::select("select p.pid,p.pname,p.ptype,p.pdec,p.cdate,p.priority,pa.* 
                from project p,project_assign pa where $eid = pa.eid and p.pid = pa.pid");
            // $data = DB::table('project')
            //         //->join('project_assign', 'project.pid', '=','project_assign.pid')
            //         ->join('project_assign', 'eid', '=', 'project_assign.eid')
            //         ->select('project.*', 'project_assign.sdate', 'project_assign.edate')
            //         ->get();

            // echo "<pre>";
            // print_r($data);
            // if(count($data)>0){
                return view('employee.manager.projects_view',compact('data'));
            // }
        }else{
            return redirect('employee');
        }
    }

    public function projects_view_detail($id)
    {
        if(session()->has('employee_login_session')){
           $detail['project'] = DB::table('project')->where('pid',$id)->get();
           $detail['project_ass'] = DB::table('project_assign')->where('pid',$id)->get();
           // echo "<pre>";
           // print_r($data);
           if(count($detail)){
                return view('employee.manager.projects_view_detail',compact('detail'));
           }else{
                return back('fail','Try again !');
           }
        }else{
            return redirect('employee');
        }
    }

    public function edit_project_status($id)
    {
       if(session()->has('employee_login_session')){
           $data['pname'] = DB::table('project')->select('pname')->where('pid',$id)->get();
           $data['pro_ass'] = DB::table('project_assign')->where('pid',$id)->get();
           // echo "<pre>";
           // print_r($data);
           // echo count($data);
           if(count($data)){
                return view('employee.manager.edit_project_status',compact('data'));
           }else{
                return back()->with('fail','Try again !');
           }
        }else{
            return redirect('employee');
        }
    }

    public function update_project_status(Request $request, $id)
    {
       if(session()->has('employee_login_session')){
           $request->validate([
                "estatus"=>"required|not_in:0"
           ]);
           if($request->estatus == 3){
                $update = DB::table('project_assign')->where('pid',$id)->update([
                    "status"=>$request->estatus
                ]);
                if($update){
                    $u = DB::table('project')->where('pid',$id)->update([
                        "status"=>3
                    ]);
                }
           }else if($request->estatus == 1 || $request->estatus == 2){
                $update = DB::table('project_assign')->where('pid',$id)->update([
                        "status"=>$request->estatus
                ]);
                if($update){
                    $u = DB::table('project')->where('pid',$id)->update([
                        "status"=>2
                    ]);
                }
           }
           if($update){
                return redirect('taskmanager_projects')->with('success','Update Successfully...');
           }else{
                return redirect('taskmanager_projects')->with('fail','No Any Chnages Apply !');
           }
        }else{
            return redirect('employee');
        }
    }

    public function create_task($id)
    {
        if(session()->has('employee_login_session')){
            $cdate = date('Y-m-d');            // current date
            $dt['project'] = DB::table('project')->select('pid','pname')->where('pid',$id)->get();
            $dt['cdate'] = $cdate;

            $eid = Session::get('employee_login_session')[0]->eid;
            $dt['member'] = DB::select("select * from employee where eid in (select eid from team_member where tid in (select tid from team where manager = $eid))");

           return view('employee.manager.create_task',compact('dt'));
        }else{
            return redirect('employee');
        }
    }

    public function add_task(Request $request,$id)
    {
        if(session()->has('employee_login_session')){
            $request->validate([
                "tname"=>"required",
                "tdec"=>"required",
                "sdate"=>"required",
                "edate"=>"required",
                "tpriority"=>"required|not_in:0",
                "eid"=>"required|not_in:0"
            ]);

            $insert = DB::table('task')->insert([
                "pid"=>$id,
                "eid"=>$request->eid,
                "tname"=>$request->tname,
                "tdec"=>$request->tdec,
                "sdate"=>$request->sdate,
                "edate"=>$request->edate,
                "tpriority"=>$request->tpriority,
                "status"=>1
            ]);
            if($insert){
                return back()->with("success","Task Assigned Successfully...");
            }else{
                return back()->with("fail","Failed | Try Again...");
            }
        }else{
            return redirect('employee');
        }
    }

    public function create_issue_project($id)
    {
        if(session()->has('employee_login_session')){
            $data['issue'] = DB::table('project_issue')->where('pid',$id)->get();
            $data['pid'] = $id;
            // echo "<pre>";
            // print_r($data);
            return view('employee.manager.create_issue_project',compact('data'));
        }else{
            return redirect('employee');
        }
    }
    public function add_project_issue(Request $request,$id)
    {
        if(session()->has('employee_login_session')){
            $request->validate([
                "issue"=>"required"
            ]);
            $insert = DB::table('project_issue')->insert([
                "pid"=>$id,
                "issue"=>$request->issue
            ]);
            if($insert){
                return back()->with("success","Issue Created Successfully...");
            }else{
                return back()->with("fail","Try Again !");
            }
        }else{
            return redirect('employee');
        }
    }
     public function edit_project_issue(Request $request,$id)
    {
        if(session()->has('employee_login_session')){
            $request->validate([
                "eissue"=>"required"
            ]);
            $update = DB::table('project_issue')->where('psid',$id)->update([
                "issue"=>$request->eissue
            ]);
            if($update){
                return back()->with("success","Issue Updated Successfully...");
            }else{
                return back()->with("fail","No Any Changes !");
            }
        }else{
            return redirect('employee');
        }
    }
    public function delete_project_issue($id)
    {
        if(session()->has('employee_login_session')){
            $delete = DB::table('project_issue')->where('psid',$id)->delete();
            if($delete){
                return back()->with("success","Issue Deleted Successfully...");
            }else{
                return back()->with("fail","Try Again !");
            }
        }else{
            return redirect('employee');
        }   
    }
    
    public function taskmanager_teams()
    {
        if(session()->has('employee_login_session')){
            $eid = Session::get('employee_login_session')[0]->eid;
            $data['team'] = DB::select("select * from team where manager=$eid");
            $data['team_m'] = DB::select("select * from team_member where tid in (select tid from team where manager=$eid)
                ");
            $data['member'] = DB::select("select * from employee where eid in 
                (select eid from team_member where tid in(select tid from team where manager=$eid))
            ");
            // $data['cnt'] = DB::select("select count(*) from employee where eid in 
            //     (select eid from team_member where tid in(select tid from team where manager=$eid))
            // ");
            
            // echo "<pre>";
            // print_r($data);
            return view('employee.manager.myteams',compact('data'));
        }else{
            return redirect('employee');
        }   
    }

    public function task()
    {
        if(session()->has('employee_login_session')){
            $eid = Session::get('employee_login_session')[0]->eid;

            $data['project'] = DB::select("
                select pid,pname,pkey from project where pid in (select pid from project_assign
                where eid = $eid)
            ");                 

            $data['task'] = DB::select("
                select e.name,t.* from task t,employee e where pid in 
                (select pid from project_assign where eid = $eid) and 
                e.eid=t.eid
            ");
            $data['pname'] = DB::select("select pname from project where pid=0");
            // echo "<pre>"; print_r($data);
            return view("employee.manager.task_view",compact('data'));
        }else{
            return redirect('employee');
        }
    }
    public function task_filter(Request $request)
    {
        if(session()->has('employee_login_session')){
            $eid = Session::get('employee_login_session')[0]->eid;
            $pid = $request->project;

            $data['project'] = DB::select("
                select pid,pname,pkey from project where pid in (select pid from project_assign
                where eid = $eid)
            ");
            if($pid == 0){
                $data['task'] = DB::select("
                    select e.name,t.* from task t,employee e where pid in 
                    (select pid from project_assign where eid = $eid) and 
                    e.eid=t.eid
                ");
                $data['pname'] = DB::select("select pname from project where pid=$pid");
            }else{
                $data['task'] = DB::select("
                    select e.name,t.* from task t,employee e where pid =$pid and 
                    e.eid=t.eid
                ");
                $data['pname'] = DB::select("select pname from project where pid=$pid");
            }

            return view("employee.manager.task_view",compact('data'));
        }else{
            return redirect('employee');
        }
    }

    public function delete_task($id)
    {
        if(session()->has('employee_login_session')){
            $delete = DB::table('task')->where('tid',$id)->delete();
            if($delete){
                return back()->with("success","Task Deleted Successfully...");
            }else{
                return back()->with("fail","Task Not Deleted !");
            }
        }else{
            return redirect('employee');
        }
    }

    public function task_view_detail($id)
    {
        if(session()->has('employee_login_session')){
            $detail = DB::table('task')->where('tid',$id)->get();
            if(count($detail)){
                return view('employee.manager.task_view_detail',compact('detail'));
            }else{
                return back()->with("fail","Try Again !");
            }
        }else{
            return redirect('employee');
        }
    }

    public function edit_task($id)
    {
        if(session()->has('employee_login_session')){
            $eid = Session::get('employee_login_session')[0]->eid;
            $data['task'] = DB::table('task')->where('tid',$id)->get();
            $data['member'] = DB::select("select * from employee where eid in 
                (select eid from team_member where tid in(select tid from team where manager=$eid))
            ");
            // echo "<pre>"; print_r($data);
            if(count($data)){
                return view('employee.manager.edit_task',compact('data'));
            }else{
                return back()->with("fail","Try Again !");
            }
        }else{
            return redirect('employee');
        }
    }

    public function update_task(Request $request,$id)
    {
        if(session()->has('employee_login_session')){
           $request->validate([
                "etname"=>"required",
                "etpriority"=>"required|not_in:0",
                "esdate"=>"required",
                "eedate"=>"required",
                "etdec"=>"required",
                "eeid"=>"required|not_in:0",
           ]);

           $update = DB::table('task')->where('tid',$id)->update([
                "eid"=>$request->eeid,
                "tname"=>$request->etname,
                "tdec"=>$request->etdec,
                "sdate"=>$request->esdate,
                "edate"=>$request->eedate,
                "tpriority"=>$request->etpriority,
           ]);
           if($update){
                return redirect('task')->with("success","Task Updated Successfully...");
           }else{
                return redirect('task')->with("fail","No Any Changes Applied...");
           }
        }else{
            return redirect('employee');
        }   
    }

    public function task_issue_view($id)
    {
       if(session()->has('employee_login_session')){
           // $data['task'] = DB::table('task')->where('pid',$id)->get();
            $data['issue'] = DB::table('task_issue')->where('tid',$id)->get();
            return view('employee.manager.task_issue_view',compact('data'));
            //echo "<pre>"; print_r($data);
        }else{
            return redirect('employee');
        } 
    }





    // member controller

    public function member_task()
    {
        if(session()->has('employee_login_session')){
           $eid = Session::get('employee_login_session')[0]->eid;
           $data['task'] = DB::table('task')->where('eid',$eid)->get();
           $data['project'] = DB::select("
                select pid,pname from project where pid in (select pid from task where eid = $eid group by pid)
            ");

           // echo "<pre>";
           // print_r($data);
           return view('employee.member.member_task',compact('data'));
        }else{
            return redirect('employee');
        } 
    }

    public function member_task_view($id)
    {
        if(session()->has('employee_login_session')){
            $detail= DB::table('task')->where('tid',$id)->get();
            return view('employee.member.member_task_view',compact('detail'));
        }else{
            return redirect('employee');
        } 
    }
 
    public function edit_task_status($id)
    {
       if(session()->has('employee_login_session')){
            $data= DB::table('task')->where('tid',$id)->get();
            // echo "<pre>";
            // print_r($data);
            return view('employee.member.edit_task_status',compact('data'));
        }else{
            return redirect('employee');
        } 
    }

    public function update_task_status(Request $request,$id)
    {
        if(session()->has('employee_login_session')){
            $request->validate([
                "estatus"=>"required|not_in:0"
            ]);
            $update = DB::table('task')->where('tid',$id)->update([
                "status"=>$request->estatus
            ]);
            if($update){
                return redirect('member_task')->with("success","Status Updated Successfully...");
           }else{
                return redirect('member_task')->with("fail","No Any Changes Applied...");
           }
        }else{
            return redirect('employee');
        } 
    }

    public function create_issue_task($id)
    {
       if(session()->has('employee_login_session')){
            $data['issue'] = DB::table('task_issue')->where('tid',$id)->get();
            $data['tid'] = $id;
            // echo "<pre>";
            // print_r($data);
            return view('employee.member.create_issue_task',compact('data'));
        }else{
            return redirect('employee');
        }
    }

    public function add_task_issue(Request $request,$id)
    {
        if(session()->has('employee_login_session')){
            $request->validate([
                "issue"=>"required"
            ]);
            $insert = DB::table('task_issue')->insert([
                "tid"=>$id,
                "issue"=>$request->issue
            ]);
            if($insert){
                return back()->with("success","Issue Created Successfully...");
            }else{
                return back()->with("fail","Try Again !");
            }
        }else{
            return redirect('employee');
        }
    }
    public function edit_task_issue(Request $request,$id)
    {
        if(session()->has('employee_login_session')){
            $request->validate([
                "eissue"=>"required"
            ]);
            $update = DB::table('task_issue')->where('tsid',$id)->update([
                "issue"=>$request->eissue
            ]);
            if($update){
                return back()->with("success","Issue Updated Successfully...");
            }else{
                return back()->with("fail","No Any Changes !");
            }
        }else{
            return redirect('employee');
        }
    }
    public function delete_task_issue($id)
    {
        if(session()->has('employee_login_session')){
            $delete = DB::table('task_issue')->where('tsid',$id)->delete();
            if($delete){
                return back()->with("success","Issue Deleted Successfully...");
            }else{
                return back()->with("fail","Try Again !");
            }
        }else{
            return redirect('employee');
        }   
    }

    public function view_myteam()
    {
        if(session()->has('employee_login_session')){
            $eid = Session::get('employee_login_session')[0]->eid;
            $data['team'] = DB::select("select * from team where tid = (select tid from team_member where eid = $eid)");
            // echo "<pre>";
            // print_r($data);

            if(!empty($data['team'])){
                $data['team_member'] = DB::table('team_member')->where('tid',$data['team'][0]->tid)->get();
                $data['employee'] = DB::table('employee')->where('role',3)->get();
                $data['manager'] = DB::table('employee')->where('eid',$data['team'][0]->manager)->get();

                return view('employee.member.view_myteam',compact('data'));
            }else{
                return view('employee.member.view_myteam',compact('data'));
            }
            // return view('employee.member.view_myteam',compact('data'));
        }else{
            return redirect('employee');
        }  
    }

}
