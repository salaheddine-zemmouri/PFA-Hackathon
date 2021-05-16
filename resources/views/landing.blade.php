@extends('layouts.master')

@section('content')
<div class="container">
    <section class="welcome">
        <div class="row">
        <div class="col-8 pt-5">
            <h5 class="display-6">Creating & Managing Hackathons</h2>
            <h6 class="display-6 hero-sub-text">Have Never Been Easier</h4>
            <p class="hero-paragraph mt-4">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
              Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus
            </p>
            <p class="hero-paragraph mt-4">
            mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa
            quis enim.</p>
            <div class="text-center">
                <button class="btn btn-primary my-btn mt-4">Get Started</button>
            </div>

        </div>
        <!--
            <div class="col-6 ">
            <img src="main_hero.svg" alt="main hero" class="img-fluid">
            </div>
        -->
    </div>
  </section>
</div>

<div class="second_hero">
    <img src={{secure_asset('images/component.svg')}} alt="" class="path">
</div>

@endsection
