@extends('layouts.front-app')
@section('content')
    <!-- Team Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5" style="max-width: 500px;">
                <h5 class="d-inline-block text-primary text-uppercase border-bottom border-5">Our Insurance Providers</h5>
                <h1 class="display-4">Qualified & Professionals</h1>
            </div>
            <div class="owl-carousel team-carousel position-relative">
                @forelse($doctors as $doctor)
                    <div class="team-item">
                        <div class="row g-0 bg-light rounded overflow-hidden">
                            <div class="col-12 col-sm-5 h-100">
                                <img class="img-fluid h-100" src="{{asset($doctor->image)}}" style="object-fit: cover;">
                            </div>
                            <div class="col-12 col-sm-7 h-100 d-flex flex-column">
                                <div class="mt-auto p-4">
                                    <h3>{{ $doctor->name }}</h3>
                                    <h6 class="fw-normal fst-italic text-primary mb-4">
                                        <a href="javascript:void(0)" mailto="{{ $doctor->email }}">{{ $doctor->email }}</a>
                                    </h6>
                                    <p class="m-0">{{ $doctor->phone }}</p>
                                </div>
                                <div class="d-flex mt-auto border-top flex-column p-4">
                                    <a class="text-decoration-none text-body pe-3" href=""><i class="bi bi-person me-2"></i>{{ $doctor->cname }}</a>
                                    <a class="text-decoration-none text-body" href=""><i class="bi bi-map me-2"></i>{{ $doctor->address }}</a>
                                </div>
                                <!-- <div class="d-flex mt-auto border-top p-4"></div> -->
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
    <!-- Team End -->
@endsection