@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                        <div class="alert alert-success">
                        @if (count($users) > 0)

                            <table class="table table-striped user-table">
                                <thead>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>&nbsp;</th>
                                </thead>
                                <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="table-text"><div>{{ $user->name }}</div></td>
                                        <!-- user Delete Button -->
                                        <td>
                                            <form action="{{ url('send/'.$user->id) }}" method="POST">
                                                {{ csrf_field() }}
		                                <input id="amount" type="text" class="form-control" name="amount" value="{{ old('amount') }}" required autofocus>

                                                <button type="submit" class="btn btn-danger">
   							Send
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        @else
                            There is no users yet.
                        @endif



                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
