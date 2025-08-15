@extends('layouts.master')

@section('title', 'Blog | Detail')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/blogs.css') }}">
@endsection

@section('content')

    {{-- blog-start --}}
    <section class="blog-section">
        <div class="container-fluid container-lg">
            <div class="row g-3">
                <div class="col-12">
                    <div class="blog-title">
                        Lorem ipsum dolor sit amet.
                    </div>
                    <div class="blog-img">
                        <figure>
                            <img src="https://media2.dev.to/dynamic/image/width=1000,height=420,fit=cover,gravity=auto,format=auto/https%3A%2F%2Fdev-to-uploads.s3.amazonaws.com%2Fuploads%2Farticles%2Fedh317r8007axukyc95z.png"
                                alt="" class="img-fluid">
                        </figure>
                    </div>
                </div>
                <div class="col-12">
                    <p>
                        In the past, creating custom components required complex combinations of HTML, CSS, and JavaScript. However, the advancement of CSS in recent years, enables us to build many components using just HTML and CSS -leveraging the logic already built into the browsers. Why reinvent the wheel when we can reuse most of it?
                    </p>
                    <p>
                        Simple components like checkboxes, radio buttons, and toggle switches can be created with HTML and CSS while relying on the browser for functionality. But we are not limited to simple components. More complex components can also be achieved this way.
                    </p>
                    <p>
                        In this article, we'll explore how to build a star rating system using a single HTML and just one JavaScript command.
                    </p>
                    <h3>The HTML</h3>
                    <p>
                        A star rating component is essentially a range of values from which users can select one. Variations may include 5 values (one per star) or 10 values (allowing half-stars), but the idea remains the same - users can select one value, and only one.
                    </p>
                </div>
            </div>
        </div>
    </section>
    {{-- blog-end --}}
    {{-- hire-me-start --}}
    @include('layouts.hireMe')
    {{-- hire-me-end --}}
@endsection

@section('scripts')
@endsection
