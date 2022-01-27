@extends('layouts/main')

@section('content')

    <main class="container">
        <div id="calculator">
            <div id="display">
                <div id="value">
                </div>
            </div>
            <div id="inputs">
                <div id="operations">
                    <button data-action="+">+</button>
                    <button data-action="-">-</button>
                    <button data-action="x">x</button>
                    <button data-action="/">/</button>
                </div>
                <div id="numbers">
                    @for($i=1;$i<=9;$i++)
                        <button data-action="{{ $i }}">{{ $i }}</button>
                    @endfor
                </div>
                <div id="actions">
                    <button data-action="clear">C</button>
                    <button data-action="0">0</button>
                    <button data-action="perform">=</button>
                </div>
            </div>
        </div>
    </main>

@endsection

@push('styles')
    <link type="text/css" rel="stylesheet" href="{{ asset('css/calculator.css') }}?t={{ time() }}"/>
@endpush

@push('scripts')
    <script src="{{ asset('js/calculator.js') }}?t={{ time() }}"></script>
@endpush