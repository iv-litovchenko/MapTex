@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Список позиций (Api Quik Tradingview)')
@section('LayoutSectionPageHeader', 'Список позиций (Api Quik Tradingview)')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('admin.apiquiktradingviewposition'))

@section('LayoutSectionPageContent')

    <div class="panel panel-default">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Стратегия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($rows as $row)
                <tr>
                    <th scope="row">s{{ $row->id }}</th>
                    <td>{{ $row->strategy }}</td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="4">Всего записей: {{ $rows->count() }}</td>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection
