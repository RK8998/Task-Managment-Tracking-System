<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\adminModel;
use Mail;
use Session;

class adminController extends Controller
{
    public function admin_Login(Request $request){
         $request->validate([
            "username"=>"required|regex:/^\S*$/u",
            "password"=>"required"
        ]);

        $q = DB::table('admin')
            ->where('username',$request->username)
            ->where('password',$request->password)->get();

        $cnt = count($q);

        $request->session()->put('admin_login_session',$q); 

        if($cnt == 1){
            return redirect('dashboard');
        }else{
            return back()->with("fail","Username or password are invalid");
        }

    }

    public function dashboard()
    {
        if(session()->has('admin_login_session')){
            $data['total_employee'] = count(DB::table('employee')->get());
            $data['total_manager'] = count(DB::table('employee')->where('role',1)->get());
            $data['total_member'] = count(DB::table('employee')->where('role',3)->get());

            $data['total_team'] = count(DB::table('team')->get());
            $data['total_project'] = count(DB::table('project')->get());
            $data['total_project_complete'] = count(DB::table('project')->where('status',3)->get());
            $data['total_project_pending'] = count(DB::table('project')->where('status',1)
                                                ->orwhere('status',2)->get());
            $data['projects'] = DB::table('project')->orderBy('pid', 'desc')->take(5)->get();
            $data['project_assign'] = DB::table('project_assign')->get();
            // echo "<pre>"; print_r($data);
            return view('admin.dashboard',compact('data'));
        }
        else{
            return redirect('admin');
        }   
    }

    public function store_employee(Request $request)
    {
        if(session()->has('admin_login_session')){
            $admin = new adminModel;
        
            $request->validate([
                "name"=>"required",
                "email"=>"required|email",
                "role"=>"required|not_in:0",
                "jdate"=>"required",
                "username"=>"required|regex:/^\S*$/u",
            ]);

            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
            $password = substr( str_shuffle( $chars ), 0, 8 );
            $encpassword = md5($password);

            $username = $request->username;
            $num = rand(1000,9990);
            $finalusername = $username.$num;

            // -----------------------------------email sending start

            $data = Session::get('admin_login_session');
 
            $data=['username'=>$finalusername,
                    'password'=>$password,
                    'name'=>$request->name,
                    'role'=>$request->role,
                    'jdate'=>$request->jdate,
                    'company'=>$data[0]->company];

            $user['to'] = $request->email;
            Mail::send('mail',$data,function($msg) use ($user){
                $msg->to($user['to']);
                $msg->subject('Login Details for TMT');
            });

            //-----------------------------------email sending end

            $query = DB::table('employee')->insert([
                "name"=>$request->name,
                "email"=>$request->email,
                "mobile"=>null,
                "gender"=>$request->gender,
                "role"=>$request->role,
                "jdate"=>$request->jdate,
                "bdate"=>null,
                "age"=>0,
                "exp"=>0,
                "username"=>$finalusername,
                "password"=>$password,
                "description"=>"-",
                "status"=>0,
                "status2"=>0,
            ]);

            if($query){
                    return redirect('add_employee')->with("success","Employee Added Sucessfully...");
            }else{
                  return redirect('add_employee')->with("fail","Try Again !");
            }
        }else{
            return redirect('admin');
        }   
    }

    public function delete_employee($id)
    {
        if(session()->has('admin_login_session')){
            $delete = DB::table('employee')->where('eid',$id)->delete();
            if($delete){
                return back()->with("success","Employee Remove Successfully");;
            }else{
                return back()->with("fail","Something went wrong");;
            }
        }else{
            return redirect('admin');
        }
    }

    public function edit_employee($id)
    {
        if(session()->has('admin_login_session')){
            $edit = DB::table('employee')->where('eid',$id)->get();
            return view('admin.update_employee', compact('edit'));   
        }else{
            return redirect('admin');
        }
    }

    public function update_employee(Request $request, $id)
    {
        if(session()->has('admin_login_session')){
            $request->validate([
                "role"=>"required|not_in:0"
            ]);
            $update = DB::table('employee')->where('eid',$id)->update([
                 "role"=>$request->role
            ]);
            $role = $request->role;
            $path = '';
            if($role == 1){
                $path = "employee_view/".$role."/0";
            }elseif($role == 23){
                $path = "employee_view/2/".$role;
            }else{
                $path = "employee_view/".$role."/23";
            }
            // echo $path;
            if($update){
                return redirect($path)->with("success","Update Successfully...");
            }else{
                return back()->with("fail","No Changes Are Apply !");
            }
        }else{
            return redirect('admin');
        }
    }

    public function fetch_employee($id1,$id2){
        if(session()->has('admin_login_session')){
            if($id2 == 0){
                $data = DB::table('employee')->where('role',$id1)->get();
                return view('admin.employee_view', compact('data'));    
            }
            else{
                $data = DB::table('employee')->where('role',$id1)->orwhere('role',$id2)->get();
                return view('admin.employee_view', compact('data'));       
            }
        }
        else{
            return redirect('admin');
        }
        
    }

    public function employee_view_detail($id)
    {
        if(session()->has('admin_login_session')){
            $detail = DB::table('employee')->where('eid',$id)->get();
            return view('admin.employee_view_detail',compact('detail'));
        }else{
            return redirect('admin');
        }
    }



    public function admin_profile_data()
    {
        if(session()->has('admin_login_session')){
            $data = DB::table('admin')->get();
            return view('admin.admin_profile', compact('data'));
        }else{
            return redirect('admin');
        }
    }

    public function admin_profile_update(Request $request, $id){
        if(session()->has('admin_login_session')){
            $request->validate([
                "username"=>"required|regex:/^\S*$/u",
                "password"=>"required|min:6|max:10",
                "email"=>"required|email",
                "company"=>"required",
                ""=>"",
            ]);
    // ***********************
            // $file = $request->file('img');
            // $destinationPath = 'img/admin'; 
            // $extension = $file->getClientOriginalExtension(); 
            // $fileName = rand(11111, 99999).'.'.$extension; 
            // $response_success = $file->move($destinationPath, $fileName); 

    // ***********************
            $update = DB::table('admin')->where('aid',$id)->update([
                 "username"=>$request->username,
                 "password"=>$request->password,
                 "email"=>$request->email,
                 "company"=>$request->company
            ]);
    // ***********************
            if(session()->has('admin_login_session')){
                session()->flush('admin_login_session');
            }
            $q = DB::table('admin')
                ->where('username',$request->username)
                ->where('password',$request->password)->get();
            $request->session()->put('admin_login_session',$q); 
    // ***********************
            if($update){
                return back()->with("success","Update Successfully...");;
            }else{
                return back()->with("fail","No Changes Are Apply !");;
            }
    // ***********************
        }
        else{
            return redirect('admin');
        }
    }

    public function admin_profile_img(Request $request, $id)
    {
        if(session()->has('admin_login_session')){
            $request->validate([
                "img"=>"required",
            ]);

            $file = $request->file('img');
            $destinationPath = 'img/admin'; 
            if($file->getClientOriginalExtension() == null){
                return back()->with("fail","No Changes Are Apply !");
            }
            $extension = $file->getClientOriginalExtension(); 
            $fileName = rand(11111, 99999).'.'.$extension; 
            $response_success = $file->move($destinationPath, $fileName); 

            $update = DB::table('admin')->where('aid',$id)->update([
                 "img"=>$fileName,
            ]);

            if($update){
                return back()->with("success","Upload Successfully...");
            }else{
                return back()->with("fail","No Changes Are Apply !");
            }
        }else{
            return redirect('admin');
        }        
    }


    public function create_team()
    {
        if(session()->has('admin_login_session')){
            $data = DB::table('employee')->get();
            return view('admin.create_team', compact('data'));
        }else{
            return redirect('admin');
        }
    }

    public function store_create_team(Request $request)
    {
        if(session()->has('admin_login_session')){
            $request->validate([
                "tname"=>"required",
                "manager"=>"required|not_in:0",
                // "leader"=>"required|not_in:0",
            ]);

            $query = DB::table('team')->insert([
                "tname"=>$request->tname,
                "manager"=>$request->manager,
                // "leader"=>$request->leader,
            ]);

            if($query){
                // $update = DB::table('employee')
                // ->where('eid',$request->manager)
                // // ->orwhere('eid',$request->leader)
                // ->update([
                //         "status"=>1,
                // ]);
                return back()->with("success","Team Create Sucessfully...");
            }else{
                return back()->with("fail","Try Again !");
            }    
        }else{
            return redirect('admin');
        }  
    }

    public function team_view() 
    {
        if(session()->has('admin_login_session')){
            $data['team'] = DB::table('team')->get();
            $data['emp'] = DB::table('employee')->get();
        
            return view('admin.team_view', compact('data'));
        }else{
            return redirect('admin');
        }
    }

    public function add_team_member($id)
    {
        if(session()->has('admin_login_session')){
            $data['team'] = DB::table('team')->where('tid',$id)->get(); 
            $data['emp'] = DB::table('employee')->get();
            return view('admin.add_team_member',compact('data'));
        }else{
            return redirect('admin');
        }
    }
     public function store_team_member(Request $request, $id)
     {
        if(session()->has('admin_login_session')){
            $request->validate([
                "team_member"=>"required|not_in:0",
            ]);

            $query = DB::table('team_member')->insert([
                "tid"=>$id,
                "eid"=>$request->team_member
            ]);
            if($query){
                $update = DB::table('employee')
                    ->where('eid',$request->team_member)
                    ->update([
                            "status"=>1,
                    ]);

                return back()->with("success","Team Member Sucessfully Added...");
            }else{
                return back()->with("fail","Try Again !");
            }   
        }else{
            return redirect('admin');
        }
     }
    public function delete_team($id)
    {
        if(session()->has('admin_login_session')){
            $data1 = DB::table('team')->where('tid',$id)->get();

            $data2 = DB::table('team_member')->where('tid',$id)->get();
            $update = 0;

            if(count($data2)>0){
                foreach($data2 as $team_member){
                    $update = DB::table('employee')
                        ->where('eid',$team_member->eid)
                        ->update([
                            "status"=>0,
                        ]);
                }
            }else{
                $update = 1;
            }

            if($update){
                $delete1 = DB::table('team')->where('tid',$id)->delete();
                $delete2 = DB::table('team_member')->where('tid',$id)->delete();
                if($delete1==1 || $delete2==1){
                    return back()->with("success","Team Deleted Successfully...");
                }else{
                    return back()->with("fail","Try Again !");
                }
            }else{
                 return back()->with("fail","Try Again !");
            }
        }else{
            return redirect('admin');
        }
    }

    public function team_view_detail($id)
    {
        if(session()->has('admin_login_session')){
            $data['teams'] = DB::table('team')->where('tid',$id)->get();

            $data['tms'] = DB::table('team_member')->where('tid',$id)->get();

            $data['emps'] = DB::table('employee')->get();

            return view('admin.team_view_detail',compact('data'));
        }else{
            return redirect('admin');
        }
    }

    public function edit_team($id)
    {
        if(session()->has('admin_login_session')){
            $data['teams'] = DB::table('team')->where('tid',$id)->get();

            $data['tms'] = DB::table('team_member')->where('tid',$id)->get();

            $data['emps'] = DB::table('employee')->get();

            return view('admin.update_team',compact('data'));
        }else{
            return redirect('admin');
        }
    }
    public function edit_delete_team_member($id)
    {
        if(session()->has('admin_login_session')){
            $update = DB::table('employee')->where('eid',$id)->update([
                "status"=>0,
            ]);
            if($update){
                $delete = DB::table('team_member')->where('eid',$id)->delete();
                if($delete){
                    return back()->with("success","Delete Successfully...");;
                }else{
                    return back()->with("fail","No Changes Are Apply !");
                }
            }else{
                 return back()->with("fail","No Changes Are Apply !");
            }
        }else{
            return redirect('admin');
        }   
    }
    public function edit_add_team_member(Request $request, $id)
    {
        if(session()->has('admin_login_session')){
            $request->validate([
                "team_member"=>"required|not_in:0",
            ]);

            $insert = DB::table('team_member')->insert([
                "tid"=>$id,
                "eid"=>$request->team_member
            ]);
            if($insert){
                $update = DB::table('employee')->where('eid',$request->team_member)->update([
                    "status"=>1,
                ]);
                if($update){
                    return back()->with("success","Team Member Added Successfully...");;
                }else{
                    return back()->with("fail","Try Again !");
                }
            }else{
                 return back()->with("fail","Try Again !");
            }
        }else{
            return redirect('admin');
        }   
    }
    public function edit_team_manager(Request $request,$id)
    {
       if(session()->has('admin_login_session')){
            $request->validate([
                "team_manager"=>"required|not_in:0"
            ]);

            $update = DB::table('team')->where('tid',$id)->update([
                "manager"=>$request->team_manager,
            ]);
           if($update){
                return back()->with("success","Team Manager Successfully Updated...");;
            }else{
                return back()->with("fail","No Changes Are Apply !");
            }
        }else{
            return redirect('admin');
        }   
    }
    public function edit_team_leader(Request $request,$id)
    {
       if(session()->has('admin_login_session')){
            $request->validate([
                "team_leader"=>"required|not_in:0"
            ]);

            $update = DB::table('team')->where('tid',$id)->update([
                "leader"=>$request->team_leader,
            ]);
           if($update){
                return back()->with("success","Team Leader Successfully Updated...");;
            }else{
                return back()->with("fail","No Changes Are Apply !");
            }
        }else{
            return redirect('admin');
        }   
    }


    public function create_project(){
        if(session()->has('admin_login_session')){
            $data = DB::select("select max(pkey) as pkey from project");
            if($data[0]->pkey != ""){
                $maxkey = $data[0]->pkey;
                $key = substr($maxkey,1);
                $pluskey = (int)$key+1;
                $finalkey = "P".(string)$pluskey;
            }else{
                $finalkey = "P101";
            }           

            $dt['pkey'] = $finalkey;        //project key
            $cdate = date('Y-m-d');         // current date
            $dt['cdate'] = $cdate;
            return view('admin.create_project',compact('dt'));
        }else{
            return redirect('admin');
        }   
    }

    public function add_project(Request $request){
         if(session()->has('admin_login_session')){
            $request->validate([
                "pkey"=>"required|min:4|max:4",
                "pname"=>"required",
                "ptype"=>"required",
                "pdec"=>"required",
                "cdate"=>"required",
                "priority"=>"required|not_in:0"
            ]);

            $insert = DB::table('project')->insert([
                "pkey"=>$request->pkey,
                "pname"=>$request->pname,
                "ptype"=>$request->ptype,
                "pdec"=>$request->pdec,
                "cdate"=>$request->cdate,
                "priority"=>$request->priority,
                "status"=>1
            ]);
            if($insert){
                return back()->with("success","Project Create Successfully...");
            }else{
                return back()->with("fail","Try Again !");
            }
        }else{
            return redirect('admin');
        }  
    }

    public function project_view(){
       if(session()->has('admin_login_session')){
            $detail = DB::table("project_assign")->where('eid',NULL)->get();
            
            foreach ($detail as $value){
                $dt = DB::table('project')->select('status')->where('pid',$value->pid)->get();
                if($dt[0]->status != 3){
                    $u = DB::table('project')->where('pid',$value->pid)->update([ "status"=>1 ]);
                    if($u){
                        $d = DB::table('project_assign')->where('paid',$value->paid)->delete();
                    }

                }
            }
            // echo "<pre>";
            // print_r($detail);
            $data = DB::table('project')->get();
            return view('admin.project_view',compact('data'));
        }else{
            return redirect('admin');
        } 
    }

    public function delete_project($id)
    {
        if(session()->has('admin_login_session')){
           $delete = DB::table('project')->where('pid',$id)->delete();
           if($delete){
                return back()->with("success","Project Deleted Successfully...");
            }else{
                return back()->with("fail","Try Again !");
            }
        }else{
            return redirect('admin');
        } 
    }

    public function project_view_detail($id)
    {
        if(session()->has('admin_login_session')){
            
            $detail['project'] = DB::table('project')->where('pid',$id)->get();
            
            $detail['pro_ass'] = DB::table('project_assign')->where('pid',$id)->get();
            
            if(count($detail['pro_ass'])!=0){
                $detail['emp'] = DB::table('employee')->select('name','username')->where('eid',$detail['pro_ass'][0]->eid)->get();
            }
            $cnt = count($detail);
            if($cnt>0){
                return view('admin.project_view_detail',compact('detail'));
            }else{
                return back()->with("fail","Try Again !");
            }
        }else{
            return redirect('admin');
        } 
    }

    public function project_issue_view($id)
    {
        if(session()->has('admin_login_session')){
            $data['project'] = DB::table('project')->where('pid',$id)->get();
            $data['issue'] = DB::table('project_issue')->where('pid',$id)->get();
            return view('admin..project_issue_view',compact('data'));
            //echo "<pre>"; print_r($data);
        }else{
            return redirect('admin');
        } 
    }
    public function project_assign($id)
    {
        if(session()->has('admin_login_session')){
            $data['emp'] = DB::table('employee')->where('role',1)->get();
            $data['project'] = $id;
            if(count($data) > 0){
                return view('admin.project_assign',compact('data'));
            }else{
                return back()->with("fail","Try Again !");
            }
        }else{
            return redirect('admin');
        } 
    }
    public function already_assign()
    {
        if(session()->has('admin_login_session')){
            return back()->with('fail','This Project is Already Assigned');
        }else{
            return redirect('admin');
        }   
    }
    public function add_project_assign(Request $request,$id)
    {
         if(session()->has('admin_login_session')){
            $request->validate([
                "eid"=>"required|not_in:0",
                "sdate"=>"required",
                "edate"=>"required"
            ]);

           $insert = DB::table('project_assign')->insert([
                "pid"=>$id,
                "eid"=>$request->eid,
                "sdate"=>$request->sdate,
                "edate"=>$request->edate,
                "status"=>1
            ]);
            if($insert){
                $update = DB::table('project')->where('pid',$id)->update([
                    "status"=>2
                ]);
                if($update){
                    return redirect('project_view')->with("success","Project Assign Successfully...");    
                }else{
                    return back()->with("fail","Try Again !");
                }
            }else{
                return back()->with("fail","Try Again !");
            }
        }else{
            return redirect('admin');
        } 
    }

    public function edit_project($id)
    {
        if(session()->has('admin_login_session')){
            $detail['project'] = DB::table('project')->where('pid',$id)->get();
            
            $detail['pro_ass'] = DB::table('project_assign')->where('pid',$id)->get();
            
            if(count($detail['pro_ass'])!=0){
                $detail['emp'] = DB::table('employee')->select('eid','name')
                ->where('role',1)->get();
            }
            $cnt = count($detail);
            if($cnt>0){
                return view('admin.update_project',compact('detail'));
            }else{
                return back()->with("fail","Try Again !");
            }
        }else{
            return redirect('admin');
        }  
    }

    public function update_project(Request $request,$id)
    {
        if(session()->has('admin_login_session')){
            $data = DB::table('project_assign')->where('pid',$id)->get();
            // echo count($data);
            if(count($data) == 0){
                $request->validate([
                    "epname"=>"required",
                    "eptype"=>"required",
                    "epdec"=>"required",
                    "ecdate"=>"required",
                    "epriority"=>"required|not_in:0"
                ]);
            }else{
                $request->validate([
                    "epname"=>"required",
                    "eptype"=>"required",
                    "epdec"=>"required",
                    "ecdate"=>"required",
                    "epriority"=>"required|not_in:0",
                    "eeid"=>"required|not_in:0",
                    "esdate"=>"required",
                    "eedate"=>"required"
                ]);
            }
            

          $update1 = DB::table('project')->where('pid',$id)->update([
                "pname"=>$request->epname,
                "ptype"=>$request->eptype, 
                "pdec"=>$request->epdec,
                "cdate"=>$request->ecdate,
                "priority"=>$request->epriority
          ]);
          $update2 = DB::table('project_assign')->where('pid',$id)->update([
                "eid"=>$request->eeid,
                "sdate"=>$request->esdate,
                "edate"=>$request->eedate
          ]);
          // echo $update1;
          // echo $update2;
          if($update1>0 || $update2>0) {
            return redirect('project_view')->with("success","Project Updated Successfully...");
          }else{
            return redirect('project_view')->with("fail","No Any Changes Applied !");
          }
        }else{
            return redirect('admin');
        } 
    }

    public function not_edit()
    {
        if(session()->has('admin_login_session')){
            return back()->with('fail','Now, This Project is not Editable');
        }else{
            return redirect('admin');
        }   
    }

    
}