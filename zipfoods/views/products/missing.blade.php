@extends('templates/master')

@section('title')
    Product not found
@endsection

@section('content')
    <h2>Product not found</h2>
    <p>Sorry we are not able to find the product you are looking for.</p>
    <a href='/products'>&larr; Return to all products</a>
@endsection
