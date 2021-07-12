@extends('backend.layouts.master')
@section('title')
Role Create
@endsection


@section('content')

        <div class="row">
            <div class="col-6 mt-5 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h2 class="header-title">Create</h2>
                        <div class="form-group">
                            <label for="example-text-input" class="col-form-label">Text</label>
                            <input class="form-control" type="text" value="Carlos Rath" id="example-text-input">
                        </div>
                        <div class="form-group">
                            <label for="example-search-input" class="col-form-label">Search</label>
                            <input class="form-control" type="search" value="Where is google office" id="example-search-input">
                        </div>
                        <div class="form-group">
                            <label for="example-email-input" class="col-form-label">Email</label>
                            <input class="form-control" type="email" value="name@example.com" id="example-email-input">
                        </div>
                        <div class="form-group">
                            <label for="example-url-input" class="col-form-label">URL</label>
                            <input class="form-control" type="url" value="https://getbootstrap.com" id="example-url-input">
                        </div>
                        <div class="form-group">
                            <label for="example-tel-input" class="col-form-label">Telephone</label>
                            <input class="form-control" type="tel" value="+880-1233456789" id="example-tel-input">
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="">Password</label>
                            <input type="password" class="form-control" id="inputPassword" value="inputPassword" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="example-number-input" class="col-form-label">Number</label>
                            <input class="form-control" type="number" value="42" id="example-number-input">
                        </div>
                        <div class="form-group">
                            <label for="example-datetime-local-input" class="col-form-label">Date and time</label>
                            <input class="form-control" type="datetime-local" value="2018-07-19T15:30:00" id="example-datetime-local-input">
                        </div>
                        <div class="form-group">
                            <label for="example-date-input" class="col-form-label">Date</label>
                            <input class="form-control" type="date" value="2018-03-05" id="example-date-input">
                        </div>
                        <div class="form-group">
                            <label for="example-month-input" class="col-form-label">Month</label>
                            <input class="form-control" type="month" value="2018-05" id="example-month-input">
                        </div>
                        <div class="form-group">
                            <label for="example-week-input" class="col-form-label">Week</label>
                            <input class="form-control" type="week" value="2018-W32" id="example-week-input">
                        </div>
                        <div class="form-group">
                            <label for="example-time-input" class="col-form-label">Time</label>
                            <input class="form-control" type="time" value="13:45:00" id="example-time-input">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Custom Select</label>
                            <select class="custom-select">
                                <option selected="selected">Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
