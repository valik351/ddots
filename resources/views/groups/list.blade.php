@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <a class="btn btn-primary" href="{{ route('teacherOnly::groups::add') }}" role="button">Add Group</a>
            </div>
        </div>
        <hr class="hidden-border">
        <div class="card">
            <div class="card-header">Groups</div>
            <div class="card-block">
                <div class="col-xs-12">
                    <table class="table table-striped table-bordered table-condensed">
                        <thead>
                        <tr>
                            <th>@include('helpers.grid-header', ['name' => 'ID',           'order' => 'id'])</th>
                            <th>@include('helpers.grid-header', ['name' => 'Name',  'order' => 'name'])</th>
                            <th>@include('helpers.grid-header', ['name' => 'Created Date', 'order' => 'created_at'])</th>
                            <th>@include('helpers.grid-header', ['name' => 'Updated Date', 'order' => 'updated_at'])</th>
                            <th>@include('helpers.grid-header', ['name' => 'Deleted Date', 'order' => 'deleted_at'])</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($groups as $group)
                            <tr>
                                <td>{{ $group->id }}</td>
                                <td class="no-wrap">{{ $group->name }}</td>
                                <td>{{ $group->created_at }}</td>
                                <td>{{ $group->updated_at }}</td>
                                <td>{{ $group->deleted_at }}</td>
                                <td>
                                    <a title="Edit"
                                       href="{{ action('GroupController@edit',['id'=> $group->id]) }}">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </a>
                                    @if (!$group->deleted_at)
                                        <a title="Delete" href="" data-toggle="confirmation"
                                           data-message="Are you sure you want to delete this group from the system?"
                                           data-btn-ok-href="{{ action('GroupController@delete', ['id'=> $group->id]) }}"
                                           data-btn-ok-label="Delete">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                    @else
                                        <a title="Restore" href="" data-toggle="confirmation"
                                           data-message="Are you sure you want to restore this group?"
                                           data-btn-ok-href="{{ action('GroupController@restore', ['id'=> $group->id]) }}"
                                           data-btn-ok-label="Restore">
                                            <i class="fa fa-repeat" aria-hidden="true"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="custom-pager">
                        {{ $groups->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
