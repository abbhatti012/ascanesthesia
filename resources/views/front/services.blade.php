@extends('layouts.front-app')
@section('content')
    <!-- Services Start -->
    <?php
        function convertToEmbeddedURL($inputURL) {
            $regex = '/^(https?:\/\/)?(www\.)?youtube\.com\/watch\?v=([A-Za-z0-9_-]+)$/i';
            if (preg_match($regex, $inputURL, $match)) {
                $videoID = $match[3];
                $embeddedURL = "https://www.youtube.com/embed/{$videoID}";
                return $embeddedURL;
            } else {
                return "";
            }
        }

        function convertToThumbnailURL($inputURL) {
            $regex = '/^(https?:\/\/)?(www\.)?youtube\.com\/watch\?v=([A-Za-z0-9_-]+)$/i';
            if (preg_match($regex, $inputURL, $match)) {
                $videoID = $match[3];
                $thumbnailURL = "https://img.youtube.com/vi/{$videoID}/maxresdefault.jpg";
                return $thumbnailURL;
            } else {
                return "";
            }
        }
    ?>
    <div class="container-fluid py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5" style="max-width: 500px;">
                <h5 class="d-inline-block text-primary text-uppercase border-bottom border-5">Services</h5>
                <h1 class="display-4">Excellent Medical Services</h1>
            </div>
            <div class="row g-5">
            @forelse($services as $service)
                <div class="col-lg-4 col-md-6">
                    <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                        <div class="video-thumbnail" onclick="showVideoPopup('{{ convertToEmbeddedURL($service->link) }}', '{{ $loop->index }}')">
                            <img class="thumbnail" src="{{ convertToThumbnailURL($service->link) }}" alt="Video Thumbnail" width="100%">
                            <div class="play-icon"></div>
                        </div>
                        <div class="overlay" id="video-popup-{{ $loop->index }}">
                            <div class="video-container">
                                <span class="close-btn" onclick="closeVideoPopup('{{ $loop->index }}')">&times;</span>
                                <iframe id="video-iframe-{{ $loop->index }}" width="100%" height="100%" frameborder="0" allowfullscreen></iframe>
                            </div>
                        </div>
                        <h4 class="mb-3">{{ $service->title }}</h4>
                        <p class="m-0" data-toggle="tooltip" data-placement="top" title="{{ $service->description }}">
                            {{ Str::limit($service->description, 100) }}
                        </p>
                        <a class="btn btn-lg btn-primary rounded-pill" href="javascript:void(0)" onclick="showVideoPopup('{{ convertToEmbeddedURL($service->link) }}', '{{ $loop->index }}')">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                @empty
            @endforelse
            </div>
        </div>
    </div>
    <script>
        // JavaScript function to show the video popup
        function showVideoPopup(videoURL, index) {
            const videoPopup = document.getElementById("video-popup-" + index);
            const videoIframe = document.getElementById("video-iframe-" + index);

            videoIframe.src = videoURL;
            videoPopup.style.display = "flex";
        }

        // JavaScript function to close the video popup
        function closeVideoPopup(index) {
            const videoPopup = document.getElementById("video-popup-" + index);
            const videoIframe = document.getElementById("video-iframe-" + index);

            videoIframe.src = "";
            videoPopup.style.display = "none";
        }
    </script>
    <!-- Services End -->

    <!-- Testimonial Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5" style="max-width: 500px;">
                <h5 class="d-inline-block text-primary text-uppercase border-bottom border-5">Testimonial</h5>
                <h1 class="display-4">Patients Say About Our Services</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="owl-carousel testimonial-carousel">
                        <div class="testimonial-item text-center">
                            <div class="position-relative mb-5">
                                <img class="img-fluid rounded-circle mx-auto" src="{{asset('front/img/testimonial-1.jpg')}}" alt="">
                                <div class="position-absolute top-100 start-50 translate-middle d-flex align-items-center justify-content-center bg-white rounded-circle" style="width: 60px; height: 60px;">
                                    <i class="fa fa-quote-left fa-2x text-primary"></i>
                                </div>
                            </div>
                            <p class="fs-4 fw-normal">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                            <hr class="w-25 mx-auto">
                            <h3>Patient Name</h3>
                            <h6 class="fw-normal text-primary mb-3">Profession</h6>
                        </div>
                        <div class="testimonial-item text-center">
                            <div class="position-relative mb-5">
                                <img class="img-fluid rounded-circle mx-auto" src="{{asset('front/img/testimonial-2.jpg')}}" alt="">
                                <div class="position-absolute top-100 start-50 translate-middle d-flex align-items-center justify-content-center bg-white rounded-circle" style="width: 60px; height: 60px;">
                                    <i class="fa fa-quote-left fa-2x text-primary"></i>
                                </div>
                            </div>
                            <p class="fs-4 fw-normal">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                            <hr class="w-25 mx-auto">
                            <h3>Patient Name</h3>
                            <h6 class="fw-normal text-primary mb-3">Profession</h6>
                        </div>
                        <div class="testimonial-item text-center">
                            <div class="position-relative mb-5">
                                <img class="img-fluid rounded-circle mx-auto" src="{{asset('front/img/testimonial-3.jpg')}}" alt="">
                                <div class="position-absolute top-100 start-50 translate-middle d-flex align-items-center justify-content-center bg-white rounded-circle" style="width: 60px; height: 60px;">
                                    <i class="fa fa-quote-left fa-2x text-primary"></i>
                                </div>
                            </div>
                            <p class="fs-4 fw-normal">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                            <hr class="w-25 mx-auto">
                            <h3>Patient Name</h3>
                            <h6 class="fw-normal text-primary mb-3">Profession</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->
@endsection