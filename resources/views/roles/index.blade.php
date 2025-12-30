@extends('menu-maker::layouts.app')

{{-- Page title --}}
@section('title', 'Role')

@section('content')
    <div class="card-header">
        @yield('title')
        <div class="btn-group float-right" role="group" aria-label="Action Group">
            <a href="{{ route('menu-maker::roles.create') }}" class="btn btn-success btn-sm" title="{{ __('menu-maker::buttons.add') }}">{{ __('menu-maker::buttons.add') }}</a>
            <a href="{{ route('menu-maker::roles.menus') }}" class="btn btn-primary btn-sm" title="{{ __('menu-maker::buttons.set-menu') }}">{{ __('menu-maker::buttons.set-menu') }}</a>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-12">
                {!! Form::open(['method' => 'GET', 'route' => 'menu-maker::roles.index', 'class' => 'form-inline']) !!}
                <div class="input-group">
                    {!! Form::text('search', request('search'), ['class' => 'form-control min-w-100', 'placeholder' => 'Search by name']) !!}
                    <!-- {!! Form::text('search', request('search'), ['class' => 'form-control', 'placeholder' => 'Search by name or alias']) !!} -->
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Search</button>
                        @if(request('search'))
                            <a href="{{ route('menu-maker::roles.index') }}" class="btn btn-outline-danger">x</a>
                        @endif
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        @include('menu-maker::partials.alert')
        <div class="dataTable_wrapper">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>{{ __('menu-maker::common.sl') }}</th>
                    <th>{{ __('menu-maker::roles.name') }}</th>
                    <th>{{ __('menu-maker::roles.is_active') }}</th>
                    <th>{{ __('menu-maker::roles.is_admin') }}</th>
                    <th>{{ __('menu-maker::common.updated_at') }}</th>
                    <th>{{ __('menu-maker::common.actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @php $x = $roles->perPage() * ($roles->currentPage() - 1); @endphp
                @foreach($roles as $role)

                    <tr class="{{ $x%2 == 0 ? 'even' : 'odd'}} gradeA">
                        <td>{{ ++$x }}</td>
                        <td>@menuMakerSearchHighlight($role->name, request('search'))</td>
                        <td>{{ __('menu-maker::roles.is_active_' . $role->is_active) }}</td>
                        <td>{{ __('menu-maker::roles.is_admin_' . $role->is_admin) }}</td>
                        <td>{{ $role->updated_at->diffForHumans() }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Action Group">
                                <a href="{{ route('menu-maker::roles.show', $role->id) }}"
                                    class="btn btn-success btn-sm"
                                    title="View Item">{{ __('menu-maker::buttons.view') }}</a>
                                <a href="{{ route('menu-maker::roles.edit', $role->id) }}"
                                    class="btn btn-primary btn-sm"
                                    title="Edit Item">{{ __('menu-maker::buttons.edit') }}</a>
                                {!! Form::open([
                                    'method'=>'DELETE',
                                    'route' => ['menu-maker::roles.destroy', $role->id],
                                    'style' => 'display:inline'
                                ]) !!}
                                    {!! Form::hidden('redirects_to', url()->full()) !!}
                                    {!! Form::button(__('menu-maker::buttons.delete'), [
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-sm',
                                        'title' => 'Delete Item',
                                        'onclick'=>'return confirm("Are you sure you want to delete ' . $role->name . '?")'
                                    ])!!}
                                {!! Form::close() !!}
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pagination float-right"> {!! $roles->appends(request()->query())->render() !!} </div>
        </div>
    </div>
@endsection
