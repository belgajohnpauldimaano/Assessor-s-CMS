<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use Crypt;
use File;

use App\pqa_assessors_info;
use App\pqa_assessors_detail;
use App\pqa_assessors_educational_background;
use App\pqa_assessors_trainings;
use App\pqa_assessors_employment_record;
use App\pqa_assessors_consultancy_work;
use App\pqa_assessors_capability_ranking;
use App\pqa_assessors_interest_conflict_disclosure;
use App\pqa_assessors_materials;

class AssessorController extends Controller
{
    public function index ()
    {

        echo "fsdafd";
        $x = date('Y');
        $y = date('1991');
        $z = $x - 26;

        echo $z;
        $pqa_assessors_info = pqa_assessors_info::with(['details'])->where('assessors_ID', Auth::user()->assessors_ID)->first();

        $pqa_assessors_educational_background = pqa_assessors_educational_background::where('assessors_ID', Auth::user()->assessors_ID)->orderBy('year_obtained','desc')->get();
        
        $pqa_assessors_trainings = pqa_assessors_trainings::where('assessors_ID', Auth::user()->assessors_ID)->orderBy('date_from', 'DESC')->get();
        
        return view('assessor_information.index', ['pqa_assessors_info' => $pqa_assessors_info, 'pqa_assessors_educational_background' => $pqa_assessors_educational_background, 'pqa_assessors_trainings' => $pqa_assessors_trainings]);
    }

    public function fetch_personal_modal ()
    {
        $pqa_assessors_info = pqa_assessors_info::with(['details'])->where('assessors_ID', Auth::user()->assessors_ID)->first();
        
        return view('assessor_information.partials.basic_info.fetch_personal_info_modal', ['pqa_assessors_info' => $pqa_assessors_info])->render();
    }
    public function fetch_personal_info_ajax () 
    {
        $pqa_assessors_info = pqa_assessors_info::with(['details'])->where('assessors_ID', Auth::user()->assessors_ID)->first();

        return view('assessor_information.partials.basic_info.get_personal_info', ['pqa_assessors_info' => $pqa_assessors_info])->render();
    }
    public function save_personal_info (Request $request)
    {
        $validator = Validator::make($request->all(), 
                        [
                            'assessors_name'            => 'required',
                            'assessors_birth_date'      => 'required|date',
                            'assessors_birth_place'     => 'required',
                            'assessors_home_address'    => 'required',
                            'assessors_tel_no'          => 'required',
                            'assessors_mobile_no'       => 'required',

                        ]
                        , 
                        [
                            'assessors_name.required'            => 'Name is required',
                            'assessors_birth_date.required'      => 'Birth date is required',
                            'assessors_birth_date.date'          => 'Provide valid date',
                            'assessors_birth_place.required'     => 'Birth place is require',
                            'assessors_home_address.required'    => 'Home addres is required',
                            'assessors_tel_no.required'          => 'Telephone number is required',
                            'assessors_mobile_no.required'       => 'Mobile number is required',
                        ]
                );

        if ($validator->fails())
        {   
            return json_encode(['errCode' => 1, 'errMsgs' => $validator->getMessageBag()]);
        }
        
        $present_date = date('Y');
        $inputted_date = date('Y' , strtotime($request->assessors_birth_date));
        $age = $present_date - $inputted_date;
        if($age < 18)
        {
            return json_encode(['errCode' => 2, 'errMsgs' => 'Your age should be atleast 18 and above.']);
        }   

        $id = decrypt($request->input('id'));

        $pqa_assessors_info                     = pqa_assessors_info::where('assessors_ID', $id)->first();
        $pqa_assessors_info->assessors_name     = $request->assessors_name;
        $pqa_assessors_info->assessors_status   = 4;
        $pqa_assessors_info->save();
        
        $pqa_assessors_detail                   = pqa_assessors_detail::where('assessors_ID', $id)->first();

        if ($pqa_assessors_detail)
        {
            $pqa_assessors_detail->date_of_birth    = date('Y-m-d', strtotime($request->assessors_birth_date));
            $pqa_assessors_detail->place_of_birth   = $request->assessors_birth_place;
            $pqa_assessors_detail->home_address     = $request->assessors_home_address;
            $pqa_assessors_detail->tel_no           = $request->assessors_tel_no;
            $pqa_assessors_detail->mobile_no        = $request->assessors_mobile_no;
            $pqa_assessors_detail->save();
        }
        else
        {   
            $pqa_assessors_detail                   = new pqa_assessors_detail();
            $pqa_assessors_detail->date_of_birth    = date('Y-m-d', strtotime($request->assessors_birth_date));
            $pqa_assessors_detail->place_of_birth   = $request->assessors_birth_place;
            $pqa_assessors_detail->home_address     = $request->assessors_home_address;
            $pqa_assessors_detail->tel_no           = $request->assessors_tel_no;
            $pqa_assessors_detail->mobile_no        = $request->assessors_mobile_no;
            $pqa_assessors_detail->date_attend_prep = '2015-05-02';
            $pqa_assessors_detail->assessors_ID     = Auth::user()->assessors_ID;
            $pqa_assessors_detail->save();
        }


        return json_encode(['errCode' => 0, 'errMsgs' => 'Personal Information successfully updated.' ]);
    }

    public function form_education_modal (Request $request)
    {
        $pqa_assessors_educational_background = null;
        if($request->id != '')
        {
            $id = decrypt($request->id);
            $pqa_assessors_educational_background = pqa_assessors_educational_background::where('id', $id)->first();
        }
        
        return view('assessor_information.partials.education.form_education_modal', ['pqa_assessors_educational_background' => $pqa_assessors_educational_background])->render();
    }

    public function fetch_education_info (Request $request)
    {
        $pqa_assessors_educational_background = pqa_assessors_educational_background::where('assessors_ID', Auth::user()->assessors_ID)->orderBy('year_obtained','desc')->get();
        return view('assessor_information.partials.education.data_education', ['pqa_assessors_educational_background' => $pqa_assessors_educational_background])->render();
    }
    public function save_education (Request $request)
    {
        $rules = [
            'id'                => 'required',
            'university_name'   => 'required',
            //'field_of_study'    => 'required',
            'degree'            => 'required',
            'year_obtained'     => 'required|date_format:Y',
            'type'              => 'required|digits:1'
        ];

        $message = [
            'id.required'                => 'Invalid selection',
            'university_name.required'   => 'Name of the university is required.',
            //'field_of_study.required'    => 'Field of study is required.',
            'degree.required'            => 'Degree is required.',
            'year_obtained.required'     => 'Year obtained is required.',
            'year_obtained.date_format'  => 'Invalid format of year :yyyy',
            'type.required'              => 'Unknown process.',
            'type.digits'                => 'Process is invalid.'
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails())
        {
            return json_encode(['errCode' => 1, 'errMsgs' => $validator->getMessageBag() ]);
        }

        if ($request->type == 1) //EDIT
        {
            $id = decrypt($request->id);
            $pqa_assessors_educational_background = pqa_assessors_educational_background::where('id', $id)->where('assessors_ID', Auth::user()->assessors_ID)->first();
            
            if($pqa_assessors_educational_background == null)
            {
                return json_encode(['errCode' => 2, 'errMsgs' => 'Selected eduation not found.' ]);
            }
            
            $pqa_assessors_educational_background->university_name  = $request->university_name;
            $pqa_assessors_educational_background->field_of_study   = $request->field_of_study;
            $pqa_assessors_educational_background->degree           = $request->degree;
            $pqa_assessors_educational_background->year_obtained    = $request->year_obtained;
            $pqa_assessors_educational_background->save();
            return json_encode(['errCode' => 0, 'errMsgs' => 'Background education successfully updated.' ]);
        }
        else //ADD
        {
            $pqa_assessors_educational_background = new pqa_assessors_educational_background();
            $pqa_assessors_educational_background->university_name  = $request->university_name;
            $pqa_assessors_educational_background->field_of_study   = $request->field_of_study;
            $pqa_assessors_educational_background->degree           = $request->degree;
            $pqa_assessors_educational_background->year_obtained    = $request->year_obtained;
            $pqa_assessors_educational_background->assessors_ID     = Auth::user()->assessors_ID;
            $pqa_assessors_educational_background->save();
            return json_encode(['errCode' => 0, 'errMsgs' => 'Background education successfully added.' ]);
        }
    }

    public function delete_education (Request $request) 
    {
        if($request->id != '')
        {
            try
            {
                $id = decrypt($request->id);

                $pqa_assessors_educational_background = pqa_assessors_educational_background::where('id', $id);

                if($pqa_assessors_educational_background == null)
                {
                    return json_encode(['errCode' => 2, 'errMsgs' => 'Invalid data.' ]);
                }

                $pqa_assessors_educational_background->delete();
                return json_encode(['errCode' => 0, 'errMsgs' => 'Background education successfully deleted.' ]);
            }
            catch (Exception $e)
            {
                return json_encode(['errCode' => 2, 'errMsgs' => 'Invalid data.' ]);
            }
        }
        else 
        {
            return json_encode(['errCode' => 1, 'errMsgs' => 'Invalid selection' ]);
        }
    }

    public function fetch_trainings (Request $request)
    {
        $pqa_assessors_trainings = pqa_assessors_trainings::where('assessors_ID', Auth::user()->assessors_ID)->orderBy('date_from', 'DESC')->get();
        return view('assessor_information.partials.trainings.data_trainings', ['pqa_assessors_trainings' => $pqa_assessors_trainings])->render();
    }

    public function form_training_modal (Request $request)
    {
        $pqa_assessors_trainings = null;
        if($request->id != '')
        {
            $id = decrypt($request->id);
            $pqa_assessors_trainings = pqa_assessors_trainings::where('id', $id)->first();
        }

        return view('assessor_information.partials.trainings.form_training_modal', ['pqa_assessors_trainings' => $pqa_assessors_trainings])->render();
    }

    public function save_training (Request $request)
    {
        $rules = [
            'id'                => 'required',
            'course'            => 'required',
            'provider'          => 'required',
            'date_from'         => 'required|date_format:m/d/Y',
            'date_to'           => 'required|date_format:m/d/Y',
            'type'              => 'required|digits:1'
        ];

        $message = [
            'id.required'                => 'Invalid selection of training.',
            'course.required'            => 'Course topic is required.',
            'provider.required'          => 'Training provider is required.',
            'date_from.required'         => 'Date from is required.',
            'date_from.date_format'      => 'Invalid format of date : mm/dd/yyyy',
            'date_to.required'           => 'Date to is required.',
            'date_to.date_format'        => 'Invalid format of date : mm/dd/yyyy',
            'type.required'              => 'Invali process.',
            'type.digits'                => 'Invalid process.'
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails())
        {
            return json_encode(['errCode' => 1, 'errMsgs' => $validator->getMessageBag() ]);
        }

        $diff = Date('Y-M-d', strtotime($request->date_from)) > Date('Y-M-d', strtotime($request->date_to));
        
        if ($diff)
        {
            return json_encode(['errCode' => 2, 'errMsgs' => 'Start date from should no be greater than to end date.' ]);
        }

        if ($request->type == 1) // Edit
        {
            try
            {
                $id = decrypt($request->id);

                $pqa_assessors_trainings = pqa_assessors_trainings::where('id', $id)->first();

                if ($pqa_assessors_trainings == null)
                {
                    return json_encode(['errCode' => 2, 'errMsgs' => 'Invalid ID.' ]);
                }

                $pqa_assessors_trainings->course    = $request->course;
                $pqa_assessors_trainings->provider  = $request->provider;
                $pqa_assessors_trainings->date_from = Date('Y-m-d', strtotime($request->date_from));
                $pqa_assessors_trainings->date_to   = Date('Y-m-d', strtotime($request->date_to));
                $pqa_assessors_trainings->save();

                return json_encode(['errCode' => 0, 'errMsgs' => 'training successfully updated.' ]);
            }
            catch (Exception $e)
            {
                return json_encode(['errCode' => 2, 'errMsgs' => 'Invalid ID.' ]);
            }
        }
        else // Add
        {
            $pqa_assessors_trainings                = new pqa_assessors_trainings();
            $pqa_assessors_trainings->course        = $request->course;
            $pqa_assessors_trainings->provider      = $request->provider;
            $pqa_assessors_trainings->date_from     = Date('Y-m-d', strtotime($request->date_from));
            $pqa_assessors_trainings->date_to       = Date('Y-m-d', strtotime($request->date_to));
            $pqa_assessors_trainings->assessors_ID  = Auth::user()->assessors_ID;
            $pqa_assessors_trainings->save();
            return json_encode(['errCode' => 0, 'errMsgs' => 'training successfully added.' ]);
        }
    }

    public function delete_training (Request $request)
    {
        if($request->id != '')
        {
            try
            {
                $id = decrypt($request->id);
                $pqa_assessors_trainings = pqa_assessors_trainings::where('id', $id);
                if($pqa_assessors_trainings == null)
                {
                    return json_encode(['errCode' => 1, 'errMsgs' => 'Invalid selection' ]);
                }
                $pqa_assessors_trainings->delete();
                return json_encode(['errCode' => 0, 'errMsgs' => 'Training successfully deleted.' ]);
            }
            catch (Exception $e)
            {
                return json_encode(['errCode' => 1, 'errMsgs' => 'Invalid selection' ]);
            }
        }
        else 
        {
            return json_encode(['errCode' => 1, 'errMsgs' => 'Invalid selection' ]);
        }
    }


    // EMPLOYMENT RECORD
    public function employment_record ()
    {
        $pqa_assessors_consultancy_work = pqa_assessors_consultancy_work::where('assessors_ID', Auth::user()->assessors_ID)->first();
        $pqa_assessors_employment_record = pqa_assessors_employment_record::where('assessors_ID', Auth::user()->assessors_ID)->orderBy('date_of_service', 'DESC')->get();
        return view('assessor_information.employment_record.index', ['pqa_assessors_consultancy_work' => $pqa_assessors_consultancy_work, 'pqa_assessors_employment_record' => $pqa_assessors_employment_record]);
    }

    public function fetch_employment_record (Request $request)
    {
        $pqa_assessors_employment_record = pqa_assessors_employment_record::where('assessors_ID', Auth::user()->assessors_ID)->orderBy('date_of_service', 'DESC')->get();
        return view('assessor_information.employment_record.partials.data_employment_record', ['pqa_assessors_employment_record' => $pqa_assessors_employment_record])->render();
    }

    public function form_employment_record_modal (Request $request)
    {
        $pqa_assessors_employment_record = null;
        if ($request->id != '')
        {
            $id = decrypt($request->id);
            $pqa_assessors_employment_record = pqa_assessors_employment_record::where('id', $id)->where('assessors_ID', Auth::user()->assessors_ID)->first();
        }

        return view('assessor_information.employment_record.partials.form_employment_record_modal', ['pqa_assessors_employment_record' => $pqa_assessors_employment_record ])->render();
    }

    public function save_employment_record (Request $request) 
    {  
        $rules = [
            'type'              => 'required|digits:1',
            'designation'       => 'required',
            'company'           => 'required',
            'address'           => 'required',
            'date_of_service'   => 'required',
            'status'            => 'required',
            'tel_no'            => 'required',
            'fax_no'            => 'required',
            'email_address'     => 'required|email',
        ];

        $messages = [
            'type.required'              => 'Unkown process.',
            'type.digits'                => 'Unkown process.',
            'designation.required'       => 'Designation is required.',
            'company.required'           => 'Company is required.',
            'address.required'           => 'Address is required.',
            'date_of_service.required'   => 'Date of service is required.',
            'status.required'            => 'Employment status is required.',
            'tel_no.required'            => 'Telephone number is required.',
            'fax_no.required'            => 'Fax number is required.',
            'email_address.required'     => 'Email address is required.',
            'email_address.email'        => 'Invalid format of email address.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails())
        {
            return json_encode(['errCode' => 1, 'errMsgs' => $validator->getMessageBag()]);
        }

        if ($request->type == 1) // EDIT
        {
            try
            {
                $id = decrypt($request->id);

                $pqa_assessors_employment_record = pqa_assessors_employment_record::where('id', $id)->where('assessors_ID', Auth::user()->assessors_ID)->first();

                if($pqa_assessors_employment_record == null)
                {
                    return json_encode(['errCode' => 1, 'errMsgs' => 'Invalid selection' ]);
                }

                $pqa_assessors_employment_record->designation       = $request->designation;
                $pqa_assessors_employment_record->company           = $request->company;
                $pqa_assessors_employment_record->parent_company    = $request->parent_company;
                $pqa_assessors_employment_record->address           = $request->address;
                $pqa_assessors_employment_record->date_of_service   = Date('Y-m-d', strtotime($request->date_of_service));
                $pqa_assessors_employment_record->employment_status = $request->status;
                $pqa_assessors_employment_record->tel_no            = $request->tel_no;
                $pqa_assessors_employment_record->fax_no            = $request->fax_no;
                $pqa_assessors_employment_record->email_address     = $request->email_address;
                $pqa_assessors_employment_record->save();


                return json_encode(['errCode' => 0, 'errMsgs' => 'Employment record successfully updated.' ]);
            }
            catch (Exception $e)
            {
                return json_encode(['errCode' => 1, 'errMsgs' => 'Invalid selection' ]);
            }
        }
        else // ADD 
        {
                $pqa_assessors_employment_record                    = new pqa_assessors_employment_record();
                $pqa_assessors_employment_record->designation       = $request->designation;
                $pqa_assessors_employment_record->company           = $request->company;
                $pqa_assessors_employment_record->parent_company    = $request->parent_company;
                $pqa_assessors_employment_record->address           = $request->address;
                $pqa_assessors_employment_record->date_of_service   = Date('Y-m-d', strtotime($request->date_of_service));
                $pqa_assessors_employment_record->employment_status = $request->status;
                $pqa_assessors_employment_record->tel_no            = $request->tel_no;
                $pqa_assessors_employment_record->fax_no            = $request->fax_no;
                $pqa_assessors_employment_record->email_address     = $request->email_address;
                $pqa_assessors_employment_record->assessors_ID      = Auth::user()->assessors_ID;
                $pqa_assessors_employment_record->save();
                return json_encode(['errCode' => 0, 'errMsgs' => 'Employment record successfully added.' ]);
        }

    }

    public function delete_employment_record (Request $request)
    {   
        try
        {
            $id = decrypt($request->id);

            $pqa_assessors_employment_record = pqa_assessors_employment_record::where('id', $id);

            if($pqa_assessors_employment_record == null)
            {
                return json_encode(['errCode' => 1, 'errMsgs' => 'Invalid selection.' ]); 
            }

            $pqa_assessors_employment_record->delete();
            return json_encode(['errCode' => 0, 'errMsgs' => 'Successfully deleted.' ]); 
        }
        catch (Exception $e)
        {
            return json_encode(['errCode' => 1, 'errMsgs' => 'Invalid selection.' ]);  
        }
    }

    public function save_consultancy (Request $request) 
    {
        $pqa_assessors_consultancy_work = pqa_assessors_consultancy_work::where('assessors_ID', Auth::user()->assessors_ID)->first();

        if ($pqa_assessors_consultancy_work) // Existing
        {
            $pqa_assessors_consultancy_work->consultancy = $request->consultancy;
            $pqa_assessors_consultancy_work->save();
            return json_encode(['errCode' => 0, 'errMsgs' => 'Consultancy Information successfully updated.' ]); 
        }
        else 
        {
            $pqa_assessors_consultancy_work = new pqa_assessors_consultancy_work();
            $pqa_assessors_consultancy_work->consultancy    = $request->consultancy;
            $pqa_assessors_consultancy_work->assessors_ID   = Auth::user()->assessors_ID;
            $pqa_assessors_consultancy_work->save();
            return json_encode(['errCode' => 0, 'errMsgs' => 'Consultancy Information successfully added.' ]); 
        }
    }


    // Capability Assessment
    public function capability_assessment () 
    {
        $pqa_assessors_capability_ranking = pqa_assessors_capability_ranking::where('assessors_ID', Auth::user()->assessors_ID)->first();
        
        $data1 = null;
        $data2 = null;
        if ($pqa_assessors_capability_ranking != null)
        {
            $data1 = [
                $pqa_assessors_capability_ranking->leadership,
                    $pqa_assessors_capability_ranking->strategy,
                    $pqa_assessors_capability_ranking->Customer,
                    $pqa_assessors_capability_ranking->measurement_analysis_knowledge_management,
                    $pqa_assessors_capability_ranking->operations,
                    $pqa_assessors_capability_ranking->workforce,
                    $pqa_assessors_capability_ranking->results,
            ];

            $data2 = [
                $pqa_assessors_capability_ranking->pr_manufacturing,
                $pqa_assessors_capability_ranking->pr_service,
                $pqa_assessors_capability_ranking->pr_education,
                $pqa_assessors_capability_ranking->pr_healthcare,
                $pqa_assessors_capability_ranking->pr_agriculture,
                $pqa_assessors_capability_ranking->pu_national_government_agencies,
                $pqa_assessors_capability_ranking->pu_local_government_units,
                $pqa_assessors_capability_ranking->pu_government_owned_controlled_corporations,
                $pqa_assessors_capability_ranking->pu_suc,
                $pqa_assessors_capability_ranking->pu_state_hospitals
            ];
        }

        return view('assessor_information.capability_assessment.index', ['pqa_assessors_capability_ranking' => $pqa_assessors_capability_ranking, 'data1' => $data1, 'data2' => $data2]);
    }

    public function save_capability_assessment (Request $request)
    {
        $rules = [
                    'input_opt1_1' => 'required|digits_between:1,7',
                    'input_opt1_2' => 'required|digits_between:1,7',
                    'input_opt1_3' => 'required|digits_between:1,7',
                    'input_opt1_4' => 'required|digits_between:1,7',
                    'input_opt1_5' => 'required|digits_between:1,7',
                    'input_opt1_6' => 'required|digits_between:1,7',
                    'input_opt1_7' => 'required|digits_between:1,7',
                    'input_opt2_1' => 'required|digits_between:1,10',
                    'input_opt2_2' => 'required|digits_between:1,10',
                    'input_opt2_3' => 'required|digits_between:1,10',
                    'input_opt2_4' => 'required|digits_between:1,10',
                    'input_opt2_5' => 'required|digits_between:1,10',
                    'input_opt2_6' => 'required|digits_between:1,10',
                    'input_opt2_7' => 'required|digits_between:1,10',
                    'input_opt2_8' => 'required|digits_between:1,10',
                    'input_opt2_9' => 'required|digits_between:1,10',
                    'input_opt2_10' => 'required|digits_between:1,10',
                ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
        {
            return response()->json(['errCode' => 1, 'errMsgs' => $validator->getMessageBag()]);
        }

        $pqa_assessors_capability_ranking = pqa_assessors_capability_ranking::where('assessors_ID', Auth::user()->assessors_ID)->first();

        if ($pqa_assessors_capability_ranking) // Edit
        {
            $pqa_assessors_capability_ranking->leadership           = $request->input_opt1_1;
            $pqa_assessors_capability_ranking->strategy             = $request->input_opt1_2;
            $pqa_assessors_capability_ranking->Customer             = $request->input_opt1_3;
            $pqa_assessors_capability_ranking->measurement_analysis_knowledge_management = $request->input_opt1_4;
            $pqa_assessors_capability_ranking->workforce            = $request->input_opt1_5;
            $pqa_assessors_capability_ranking->operations           = $request->input_opt1_6;
            $pqa_assessors_capability_ranking->results              = $request->input_opt1_7;
            $pqa_assessors_capability_ranking->pr_manufacturing     = $request->input_opt2_1;
            $pqa_assessors_capability_ranking->pr_service           = $request->input_opt2_2;
            $pqa_assessors_capability_ranking->pr_education         = $request->input_opt2_3;
            $pqa_assessors_capability_ranking->pr_healthcare        = $request->input_opt2_4;
            $pqa_assessors_capability_ranking->pr_agriculture       = $request->input_opt2_5;
            $pqa_assessors_capability_ranking->pu_national_government_agencies = $request->input_opt2_6;
            $pqa_assessors_capability_ranking->pu_local_government_units = $request->input_opt2_7;
            $pqa_assessors_capability_ranking->pu_government_owned_controlled_corporations = $request->input_opt2_8;
            $pqa_assessors_capability_ranking->pu_suc               = $request->input_opt2_9;
            $pqa_assessors_capability_ranking->pu_state_hospitals   = $request->input_opt2_10;
            $pqa_assessors_capability_ranking->save();

            return response()->json(['errCode' => 0, 'msg' => 'Capability assessment ranking successfully updated.']);
        }
        else // Add
        {   
            $pqa_assessors_capability_ranking = new pqa_assessors_capability_ranking();
            $pqa_assessors_capability_ranking->leadership           = $request->input_opt1_1;
            $pqa_assessors_capability_ranking->strategy             = $request->input_opt1_2;
            $pqa_assessors_capability_ranking->Customer             = $request->input_opt1_3;
            $pqa_assessors_capability_ranking->measurement_analysis_knowledge_management = $request->input_opt1_4;
            $pqa_assessors_capability_ranking->workforce            = $request->input_opt1_5;
            $pqa_assessors_capability_ranking->operations           = $request->input_opt1_6;
            $pqa_assessors_capability_ranking->results              = $request->input_opt1_7;
            $pqa_assessors_capability_ranking->pr_manufacturing     = $request->input_opt2_1;
            $pqa_assessors_capability_ranking->pr_service           = $request->input_opt2_2;
            $pqa_assessors_capability_ranking->pr_education         = $request->input_opt2_3;
            $pqa_assessors_capability_ranking->pr_healthcare        = $request->input_opt2_4;
            $pqa_assessors_capability_ranking->pr_agriculture       = $request->input_opt2_5;
            $pqa_assessors_capability_ranking->pu_national_government_agencies = $request->input_opt2_6;
            $pqa_assessors_capability_ranking->pu_local_government_units = $request->input_opt2_7;
            $pqa_assessors_capability_ranking->pu_government_owned_controlled_corporations = $request->input_opt2_8;
            $pqa_assessors_capability_ranking->pu_suc               = $request->input_opt2_9;
            $pqa_assessors_capability_ranking->pu_state_hospitals   = $request->input_opt2_10;
            $pqa_assessors_capability_ranking->assessors_ID         = Auth::user()->assessors_ID;
            $pqa_assessors_capability_ranking->save();

            return response()->json(['errCode' => 0, 'msg' => 'Capability assessment ranking successfully added.']);
        }

    }

    public function disclosure_conflict_interest ()
    {
        $pqa_assessors_interest_conflict_disclosure = pqa_assessors_interest_conflict_disclosure::where('assessors_ID', Auth::user()->assessors_ID)->get();
        return view('assessor_information.disclosure_conflict_interest.index', ['pqa_assessors_interest_conflict_disclosure' => $pqa_assessors_interest_conflict_disclosure]);
    }

    public function disclosure_conflict_interest_records ()
    {
        $pqa_assessors_interest_conflict_disclosure = pqa_assessors_interest_conflict_disclosure::where('assessors_ID', Auth::user()->assessors_ID)->get();
        
        return view('assessor_information.disclosure_conflict_interest.partials.disclosure_conflict_interest_records', ['pqa_assessors_interest_conflict_disclosure' => $pqa_assessors_interest_conflict_disclosure])->render();
    }

    public function disclosure_conflict_interest_form_modal (Request $request)
    {
        $pqa_assessors_interest_conflict_disclosure = null;

        if($request->id != null)
        {
            $id = decrypt($request->id);
            //->where('assessors_ID', Auth::user()->assesors_ID)
            $pqa_assessors_interest_conflict_disclosure = pqa_assessors_interest_conflict_disclosure::where('id', $id)->first();
        }
        
        return view('assessor_information.disclosure_conflict_interest.partials.disclosure_conflict_interest_form_modal', ['pqa_assessors_interest_conflict_disclosure' => $pqa_assessors_interest_conflict_disclosure])->render();
    }

    public function disclosure_conflict_interest_delete (Request $request)
    {
        if($request->id != null)
        {
            try
            {
                $id = decrypt($request->id);
                $pqa_assessors_interest_conflict_disclosure = pqa_assessors_interest_conflict_disclosure::where('id', $id)->where('assessors_ID', Auth::user()->assessors_ID);
                
                if ($pqa_assessors_interest_conflict_disclosure == null)
                {
                    return response()->json(['errCode' => 1, 'errMsgs' => 'Unable to delete. Invalid selection']);
                }
                $pqa_assessors_interest_conflict_disclosure->delete();
                return response()->json(['errCode' => 0, 'errMsgs' => 'Successfully deleted.']);
            }
            catch (Exception $e)
            {
                return response()->json(['errCode' => 1, 'errMsgs' => 'Unable to delete. Invalid selection']);
            }
        }
        else
        {
            return response()->json(['errCode' => 1, 'errMsgs' => 'Unable to delete. Invalid selection']);
        }
    }

    public function disclosure_conflict_interest_save (Request $request)
    {
        $rules = [
                    'organizations' => 'required',
                    'industries'    => 'required',
                    'type'          => 'required|digits_between:1,2',
                ];

        $messages = [
                    'organizations.required' => 'Organization is required.',
                    'industries.required'    => 'Industry is required',
                    'type.required'          => 'Invalid process.',
                    'type.digits_between'    => 'Invalid process',
                ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails())
        {
            return response()->json(['errCode' => 1, 'errMsgs' => $validator->getMessageBag()]);
        }

        if($request->type == 1) // Edit
        {
            try
            {
                $id = decrypt($request->id);

                $pqa_assessors_interest_conflict_disclosure = pqa_assessors_interest_conflict_disclosure::where('id', $id)->where('assessors_ID', Auth::user()->assessors_ID)->first();

                if ($pqa_assessors_interest_conflict_disclosure != null) 
                {   
                    $pqa_assessors_interest_conflict_disclosure->organizations  = $request->organizations;
                    $pqa_assessors_interest_conflict_disclosure->industries     = $request->industries;
                    $pqa_assessors_interest_conflict_disclosure->save();

                    return response()->json(['errCode' => 0, 'errMsgs' => 'Record successfully added.']);
                }
                else
                {
                    return response()->json(['errCode' => 1, 'errMsgs' => 'Invalid selection.']);
                }

            }
            catch (Exception $e)
            {
                return response()->json(['errCode' => 1, 'errMsgs' => 'Invalid selection.']);
            }
        }
        else // Add
        {   
            $pqa_assessors_interest_conflict_disclosure = new pqa_assessors_interest_conflict_disclosure();
            $pqa_assessors_interest_conflict_disclosure->organizations  = $request->organizations;
            $pqa_assessors_interest_conflict_disclosure->industries     = $request->industries;
            $pqa_assessors_interest_conflict_disclosure->assessors_ID   = Auth::user()->assessors_ID;
            $pqa_assessors_interest_conflict_disclosure->save();

            return response()->json(['errCode' => 0, 'errMsgs' => 'Record successfully added.']);
        }
    }

    public function materials ()
    {
        $pqa_assessors_materials = pqa_assessors_materials::all();
        return view('assessor_information.materials.index', ['pqa_assessors_materials' => $pqa_assessors_materials]);
    }

    public function download_file ($file)
    {
        $pqa_assessors_materials = pqa_assessors_materials::where('material_ID', $file)->first();
        $path = public_path('../../uploads/assessors_material/'.$pqa_assessors_materials->material_file);
        if(file_exists($path))
        {
            return response()->download($path);
        }
        echo "File not found.";
        return;
    }

    public function materials_download($file)
    {
        // //$path = public_path('../../uploads/awardees/awardee-3.jpg');
        // $pqa_assessors_materials = pqa_assessors_materials::where('id', $file)->first();
        // //$path = public_path('../../uploads/assessors_material/'.$pqa_assessors_materials->material_file);
        
        // return json_encode($pqa_assessors_materials);
        // //return response()->download($path);
    }
}

