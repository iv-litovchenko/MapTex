@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Цена биткоина')
@section('LayoutSectionPageHeader', 'Цена биткоина')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('site.bitcoin'))

@section('LayoutSectionPageContent')

    @if(isset($error))
        <div class="alert alert-danger">
            {{ $error }}
        </div>
    @elseif(isset($priceData))
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <span class="glyphicon glyphicon-bitcoin" aria-hidden="true"></span>
                            Текущая цена Bitcoin (BTC)
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="well">
                                    <h4>USD</h4>
                                    <h2 class="text-primary">${{ $priceData['usd']['price'] }}</h2>
                                    @if(isset($priceData['usd']['change_24h']))
                                        <p class="text-{{ $priceData['usd']['change_24h'] >= 0 ? 'success' : 'danger' }}">
                                            <span class="glyphicon glyphicon-arrow-{{ $priceData['usd']['change_24h'] >= 0 ? 'up' : 'down' }}" aria-hidden="true"></span>
                                            {{ $priceData['usd']['change_24h'] >= 0 ? '+' : '' }}{{ $priceData['usd']['change_24h'] }}% за 24ч
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="well">
                                    <h4>EUR</h4>
                                    <h2 class="text-primary">€{{ $priceData['eur']['price'] }}</h2>
                                    @if(isset($priceData['eur']['change_24h']))
                                        <p class="text-{{ $priceData['eur']['change_24h'] >= 0 ? 'success' : 'danger' }}">
                                            <span class="glyphicon glyphicon-arrow-{{ $priceData['eur']['change_24h'] >= 0 ? 'up' : 'down' }}" aria-hidden="true"></span>
                                            {{ $priceData['eur']['change_24h'] >= 0 ? '+' : '' }}{{ $priceData['eur']['change_24h'] }}% за 24ч
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="well">
                                    <h4>RUB</h4>
                                    <h2 class="text-primary">{{ $priceData['rub']['price'] }} ₽</h2>
                                    @if(isset($priceData['rub']['change_24h']))
                                        <p class="text-{{ $priceData['rub']['change_24h'] >= 0 ? 'success' : 'danger' }}">
                                            <span class="glyphicon glyphicon-arrow-{{ $priceData['rub']['change_24h'] >= 0 ? 'up' : 'down' }}" aria-hidden="true"></span>
                                            {{ $priceData['rub']['change_24h'] >= 0 ? '+' : '' }}{{ $priceData['rub']['change_24h'] }}% за 24ч
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Объем торгов за 24ч</h3>
                                    </div>
                                    <div class="panel-body">
                                        <h4>${{ $priceData['volume_24h'] ?? 'N/A' }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Рыночная капитализация</h3>
                                    </div>
                                    <div class="panel-body">
                                        <h4>${{ $priceData['market_cap'] ?? 'N/A' }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-muted text-center">
                            <small>
                                <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                                Обновлено: {{ $priceData['updated_at'] }}
                            </small>
                        </div>

                        <div class="text-center" style="margin-top: 20px;">
                            <button class="btn btn-primary" onclick="location.reload()">
                                <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                                Обновить данные
                            </button>
                            <a href="{{ route('site.bitcoin-history') }}?format=json&days=7&currency=usd" 
                               class="btn btn-info" 
                               target="_blank">
                                <span class="glyphicon glyphicon-stats" aria-hidden="true"></span>
                                История (JSON)
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-warning">
            Данные о цене биткоина недоступны.
        </div>
    @endif

@stop
