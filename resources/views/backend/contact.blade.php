@extends('backend.layouts.app')

@section('content')

<div class="card">

    <div class="card-header row gutters-5">
        <div class="col text-center text-md-left">
            <h5 class="mb-md-0 h6">{{ translate('Contacts') }}</h5>
        </div>

    </div>


    <div class="card-body">
        <table class="aiz-table" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th data-breakpoints="lg">{{ translate('S.N') }}</th>
                    <th data-breakpoints="lg">{{ translate('First Name') }}</th>
                    <th data-breakpoints="lg">{{ translate('Last Name') }}</th>

                    <th data-breakpoints="lg">{{ translate('Email') }}</th>

                    <th data-breakpoints="lg">{{ translate('Phone') }}</th>
                    <th data-breakpoints="lg">{{ translate('Message') }}</th>


                    <th class="text-right">{{ translate('Options') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)

                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $contact->first_name }}</td>
                    <td>{{ $contact->last_name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->mobile }}</td>
                    <td>{{ $contact->message }}</td>

                    <td class="text-right">


                        <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{ route('contact.delete', $contact->id) }}" title="{{ translate('Delete') }}">
                            <i class="las la-trash"></i>
                        </a>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
        <div class="clearfix">
            <div class="pull-right">
                {{-- $contacts->appends(request()->input())->links() --}}
            </div>
        </div>
    </div>
</div>

@endsection

@section('modal')
<!-- Delete modal -->
@include('modals.delete_modal')
<!-- Bulk Delete modal -->

@endsection