<?php /** @var \Symfony\Component\HttpKernel\Exception\HttpExceptionInterface $exception */ ?>

@extends('partials.template')

@section('body')
    <div class="flex-grow w-full relative flex flex-col items-center justify-center text-gray-900">
        <div class="mb-4">
            <div class="inline-block align-middle text-3xl text-center px-4">
                {{ $exception->getStatusCode() }}
            </div>

            @if(!empty($exception->getMessage()))
                <div class="inline-block align-middle text-xl text-center px-4 py-3 border-l-2 border-gray-500">
                    {{ $exception->getMessage() }}
                </div>
            @endif
        </div>

        <div>
            <a href="{{ url()->previous(true) }}" class="text-lg underline">
                @lang('Go Back')
            </a>
        </div>
    </div>
@endsection
