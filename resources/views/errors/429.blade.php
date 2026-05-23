@extends('errors.layout')

@section('title', 'Too Many Requests')
@section('code', '429')
@section('message', 'Slow Down!')
@section('description', 'You have made too many requests. Please wait a moment before trying again.')
