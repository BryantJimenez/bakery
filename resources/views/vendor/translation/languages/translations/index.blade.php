@extends('translation::layout')

@section('title', trans('admin.languages.titles.translations.index'))

@section('links')
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/datatables.css') }}">
<link href="{{ asset('/admins/vendor/sweetalerts/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/admins/vendor/sweetalerts/sweetalert.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/admins/css/components/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<div class="row layout-top-spacing">

    <div class="col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>@lang('admin.languages.titles.translations.index')</h4>
                    </div>                 
                </div>
            </div>
            <div class="widget-content widget-content-area shadow-none">

                <div class="row">
                    <div class="col-12">
                        @include('translation::notifications')

                        <form action="{{ route('languages.translations.index', ['language' => $language]) }}" method="get" class="row">
                            {{-- <div class="form-group col-12">
                                <div class="text-right">
                                    <a href="{{ route('languages.translations.create', $language) }}" class="btn btn-primary">@lang('form.buttons.add')</a>
                                </div>    
                            </div> --}}

                            <div class="form-group col-lg-5 col-md-4 col-12">
                                @include('translation::forms.search', ['name' => 'filter', 'value' => Request::get('filter')])
                            </div>

                            <div class="form-group col-lg-2 col-md-3 col-4">
                                @include('translation::forms.select', ['name' => 'language', 'items' => $languages, 'submit' => true, 'selected' => $language])
                            </div>

                            <div class="form-group col-lg-5 col-md-4 col-8">
                                @include('translation::forms.select', ['name' => 'group', 'items' => $groups, 'submit' => true, 'selected' => Request::get('group'), 'optional' => true])
                            </div>
                        </form>

                        <div class="table-responsive mb-4 mt-4">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>@lang('admin.languages.info.group single')</th>
                                        <th>@lang('admin.languages.info.key')</th>
                                        <th>{{ config('app.locale') }}</th>
                                        <th>{{ $language }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($translations))
                                    @foreach($translations as $type => $items)

                                    @foreach($items as $group => $translations)

                                    @foreach($translations as $key => $value)

                                    @if(!is_array($value[config('app.locale')]))
                                    <tr>
                                        <td>{{ $group }}</td>
                                        <td>{{ $key }}</td>
                                        <td>{{ $value[config('app.locale')] }}</td>
                                        <td>
                                            <translation-input initial-translation="{{ $value[$language] }}" language="{{ $language }}" group="{{ $group }}" translation-key="{{ $key }}" route="{{ config('translation.ui_url') }}"></translation-input>
                                        </td>
                                    </tr>
                                    @endif

                                    @endforeach

                                    @endforeach

                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>                                        
                </div>

            </div>
        </div>
    </div>

</div>

@endsection

@section('scripts')
<script src="{{ asset('/admins/vendor/table/datatable/datatables.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/custom-sweetalert.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection