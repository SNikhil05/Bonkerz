@extends('backend.layouts.app')

@section('content')

<div class="card">
    <form class="" id="sort_support" action="" method="GET">
        <div class="card-header row gutters-5">
            <div class="col text-center text-md-left">
                <h5 class="mb-md-0 h6">{{ translate('Reels') }}</h5>
            </div>
            <div class="col-md-2">
                <a class="btn btn-primary" href="{{ route('addReel') }}">Add New</a>
            </div>
        </div>
    </form>

    <div class="card-body">
        <table class="aiz-table" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th data-breakpoints="lg">{{ translate('S.N') }}</th>
                    <th data-breakpoints="lg">{{ translate('Title') }}</th>
                    <th data-breakpoints="lg">{{ translate('Reel') }}</th>

                    <th class="text-right">{{ translate('Options') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reels as $reel)

                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $reel->title }}</td>
                    <td><a href="{{ asset('storage/' . $reel->reel_path) }}" target="_blank">link</a></td>

                    <td class="text-right">
                        <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('reel.edit', $reel->id)}}" title="{{ translate('Edit') }}">
                            <i class="las la-edit"></i>
                        </a>

                        <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{ route('reel.delete', $reel->id) }}" title="{{ translate('Delete') }}">
                            <i class="las la-trash"></i>
                        </a>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
        <div class="clearfix">
            <div class="pull-right">
                {{-- $reels->appends(request()->input())->links() --}}
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