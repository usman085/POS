<?php
namespace App\Repositories;

use App\Repositories\Interfaces\ProgramInterface;
use App\Models\Program;
use DB;

class ProgramRepository implements ProgramInterface {

    /**
    * Insert Program
    *
    * @param request
    * @return Response Insert Program Data
    */

    public function insertProgram( $request )
    {
        $program = Program::create( $request->all() );

        return response( ['Program'=> $program], 200 );
    }

    /**
    * Get Program
    *
    * @param request
    * @return Response Get Program Data
    */

    public function getProgram()
    {
        $getProgram = Program::all();

        return response( ['allProgram'=>$getProgram], 200 );
    }

    /**
    * Delete Program
    *
    * @param request
    * @return Response Delete Program Data
    */

    public function deleteProgram( $request ) 
    {
        $deleteProgram = Program::find( $request->id )->delete();

        if ( $deleteProgram ) 
        {
            return response( ['deleteProgram'=>$deleteProgram], 200 );
        } else {
            return response( ['Server Error'=>$deleteProgram], 402 );
        }
    }

    /**
    * Assign  Course
    *
    * @param request
    * @return Response Assign Courses to Program
    */

    public function AssignCourses( $request )
    {
        return Program::find( $request->id )->AssignedCourses()->get();
    }

    /**
    * Edit Program
    *
    * @param request
    * @return Response Edit Program Data
    */

    public function editProgram( $request ) 
    {

        $editProgram = Program::where( 'id', $request->id )->update(
            [
                'program_title'=> $request->program_title,
                'program_short_title'=> $request->program_short_title,
                'program_duration'=>$request->program_duration,
                'no_of_semester'=>$request->no_of_semester,
            ] );

            if ( $editProgram ) 
            {
                return response( ['editProgram'=>$editProgram], 200 );
            } else {
                return response( ['Server Error'=>$editProgram], 402 );
            }

    }

    /**
    * Assign Course To Program
    *
    * @param request
    * @return Response Insert Program Data
    */

    public function AssignCourseToProgram( $request )
    {
        foreach ( $request->selected as $course_id ) {
            if ( !DB::table( 'course_program' )->where( 'program_id', $request->program_id )->where( 'semester', $request->semester )->where( 'course_id', $course_id )->first() )
            {
                $insert = DB::table( 'course_program' )->insert( [
                    'program_id'=>$request->program_id,
                    'course_id'=>$course_id,
                    'semester'=>$request->semester
                ] );
            }
        }

        return response( ['message'=>'Insert successfully'], 200 );
    }

    /**
    *  Delete Assign Course program
    *
    * @param request
    * @return Response Message with Code 
    */

    public function delAssignCourse( $request ) {
        $del = DB::table( 'course_program' )->where( 'id', $request->id )->delete();
            if ( $del ) {
                return response( ['message'=>'Delete SuccessFully'], 200 );
            } else {
                return response( ['message'=>'Error'], 422 );
            }
    }
}