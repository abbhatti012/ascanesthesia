@extends('layouts.backend')

@section('css_before')
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <style>
        .swal2-popup{
            width: 36% !important;
        }
    </style>
@endsection

@section('js_after')
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
    function displayPayerDetails(payerDetails) {
        var html = '<table class="table table-bordered" style="width: 300px; height: 200px; overflow: auto;">';
        html += '<thead><tr><th>Key</th><th>Value</th></tr></thead>';
        html += '<tbody>';
        
        // Convert payerDetails object to an array of key-value pairs
        var payerDetailsArray = Object.entries(payerDetails);
        console.log('Pair is ', payerDetailsArray)

        // Iterate over the array and generate HTML for table rows
        payerDetailsArray.forEach(function(pair) {
            var key = pair[0];
            var value = pair[1];
            // Check if value is null
            if (value === null) {
                value = 'null'; // Display 'null' as a string
            } else if (typeof value === 'object') {
                // Convert nested objects to JSON strings
                value = JSON.stringify(value);
            }
            // Append key-value pair to table rows
            html += '<tr><td>' + key + '</td><td>' + value + '</td></tr>';
        });

        html += '</tbody></table>';

        // Display the popup with the dynamically generated table
        Swal.fire({
            title: 'Payer Details',
            html: html,
            confirmButtonText: 'Close'
        });
    }
</script>



@endsection

@section('content')
    <div class="content">
        <div class="my-50">
            <h2 class="content-heading">All Payments
            </h2>
        </div>

        <div class="block">
            @if(Session::has('message'))
                <div class="alert alert-{{session('message')['type']}}">
                    {{session('message')['text']}}
                </div>
            @endif
            <div class="block-header block-header-default">
                <h3 class="block-title">Payment Details</h3>
            </div>
            <div class="block-content block-content-full">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 80px;">#</th>
                            <th>Invoice Number</th>
                            <th class="d-none d-sm-table-cell" style="width: 30%;">Name</th>
                            <th class="d-none d-sm-table-cell" style="width: 30%;">Email</th>
                            <th class="d-none d-sm-table-cell" style="width: 30%;">Amount</th>
                            <th class="d-none d-sm-table-cell" style="width: 30%;">Currency</th>
                            <th class="d-none d-sm-table-cell" style="width: 30%;">Payment Method</th>
                            <th class="d-none d-sm-table-cell" style="width: 30%;">Status</th>
                            <th class="d-none d-sm-table-cell" style="width: 30%;">Payment Details</th>
                            <th style="width: 15%;">Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($appointments as $app)
                        <tr>
                            <td class="text-center">{{ $loop->index + 1 }}</td>
                            <td class="d-none d-sm-table-cell">
                                {{ $app->invoice_number }}
                            </td>
                            <td class="d-none d-sm-table-cell">
                                {{ $app->name }}
                            </td>
                            <td class="d-none d-sm-table-cell">
                                <a href="mailto:<?= $app->email ?>">{{ $app->email }}</a>
                            </td>
                            <td class="d-none d-sm-table-cell">
                                {{ number_format($app->amount, 2, '.', '') }}
                            </td>
                            <td class="d-none d-sm-table-cell">
                                {{ strtoupper($app->currency) }}
                            </td>
                            <td class="d-none d-sm-table-cell">
                                {{ strtoupper($app->paymentMethod) }}
                            </td>
                            <td class="d-none d-sm-table-cell">
                            @php
                                $statusClass = '';
                                switch($app->status) {
                                    case 'approved':
                                        $statusClass = 'badge-success';
                                        break;
                                    case 'succeeded':
                                        $statusClass = 'badge-secondary';
                                        break;
                                    default:
                                        $statusClass = 'badge-danger';
                                }
                            @endphp
                            <span class="badge {{ $statusClass }}">{{ $app->status }}</span>
                            </td>
                            <td class="d-none d-sm-table-cell">
                                <a href="javascript:void(0)" class="js-swal-confirm btn btn-lg btn-circle btn-alt-info mr-5 mb-5" title="View Details" onclick="displayPayerDetails({{ $app->payerDetails }})">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                            <td>
                                <em class="text-muted">{{ $app->created_at->format("F j, Y") }}</em>
                            </td>
                        </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
