@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                        <div class="alert alert-success">
		<!-- Send Requests begin --!>
                        @if (count($send_requests) > 0)
                            <table class="table table-striped user-table">
                                <thead>
                                <th>Requester</th>
                                <th>Amount</th>
                                <th>Request Date</th>
                                <th>&nbsp;</th>
                                </thead>
                                <tbody>
                                @foreach ($send_requests as $sreq)
                                    <tr>
                                        <td class="table-text"><div>{{ $sreq->name }}</div></td>
                                        <td class="table-text"><div>{{ $srec->amount }}</div></td>
                                        <td class="table-text"><div>{{ $srec->tx_at }}</div></td>
                                        <!-- accept Button -->
                                        <td>
                                            <form action="{{ url('accept/'.$srec->tx_id) }}" method="POST">
                                                {{ csrf_field() }}

                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-btn fa-trash"></i>Accept
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        @else
                            There is no send requests.
                        @endif

		<!-- Send Requests endn --!>

		<!-- Receive  Requests begin --!>
                        @if (count($receive_requests) > 0)
                            <table class="table table-striped user-table">
                                <thead>
                                <th>Sender</th>
                                <th>Amount</th>
                                <th>Request Date</th>
                                <th>&nbsp;</th>
                                </thead>
                                <tbody>
                                @foreach ($receive_requests as $rreq)
                                    <tr>
                                        <td class="table-text"><div>{{ $rreq->name }}</div></td>
                                        <td class="table-text"><div>{{ $rreq->amount }}</div></td>
                                        <td class="table-text"><div>{{ $rreq->tx_at }}</div></td>
                                        <!-- accept Button -->
                                        <td>
                                            <form action="{{ url('accept/'.$rreq->tx_id) }}" method="POST">
                                                {{ csrf_field() }}

                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-btn fa-trash"></i>Accept
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        @else
                            There is no receive requests.
                        @endif

		<!-- Receive  Requests end --!>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
