@extends('layouts.main')

@section('content')
    <row>
        <div class="col-md-12">
            <h3 class="page-header">Dashboard</h3>
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-body">
                    <div>
                        Good day 
                         <h3> {{ Auth::user()->assessors_name }} </h3>
                    </div>

                    @if (Auth::user()->assessors_default_password != '')
                        <p id="js-link_change">
                            You are not yet changed you password <a href="#" class="btn-link js-change_password">click to change to change.</a>
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </row>
@endsection
