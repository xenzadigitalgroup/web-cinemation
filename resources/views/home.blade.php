<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TMN | The Movie Now</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-600">
<div class="w-full h-auto min-h-screen flex flex-col">
    <!-- Header Section -->
    <div class="z-10">
        @include('header')
    </div>

    <!-- Banner Section -->
    <div class="w-full h-[512px] flex flex-col relative bg-gray-600">
        
        <!-- Banner Data -->
        @foreach($banner as $bannerItem)
        
        @php
        $bannerImage = "{$imageBaseURL}/original{$bannerItem->backdrop_path}";
        @endphp
        <div class="flex flex-row items-center w-full h-full relative slide">
            <!-- Image -->
            <img src="{{$bannerImage}}" class="absolute w-full h-full object-cover" />

            <!-- Overlay -->
            <div class="w-full h-full absolute bg-black bg-opacity-40"></div>

            <div class="w-10/12 flex flex-col ml-28 z-10">
                <span class="font-bold font-inter text-4xl text-white">{{ $bannerItem->title }}</span>
                <span class="font-inter text-xl text-white w-1/2 line-clamp-2">{{ $bannerItem->overview }}</span>
                <a href="/movie/{{ $bannerItem->id }}" class="w-fit bg-gray-400 text-black pl-2 pr-4 py-2 mt-5 font-inter text-sm flex flex-row rounded-full items-center hover:drop-shadow-lg duration-200">
                <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 11.9999V8.43989C4 4.01989 7.13 2.2099 10.96 4.4199L14.05 6.1999L17.14 7.9799C20.97 10.1899 20.97 13.8099 17.14 16.0199L14.05 17.7999L10.96 19.5799C7.13 21.7899 4 19.9799 4 15.5599V11.9999Z" stroke="#ffffff" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="text-white">Detail</span>
                </a>
            </div>
        </div>
        @endforeach
        
        <!-- Prev Button -->
        <div class="absolute left-4 top-1/2 -translate-y-1/2 flex justify-center" onclick="moveSlide(-1)">
            <button class="bg-white p-3 rounded-full opacity-20 hover:opacity-100 duration-200">
            <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M14.2893 5.70708C13.8988 5.31655 13.2657 5.31655 12.8751 5.70708L7.98768 10.5993C7.20729 11.3805 7.2076 12.6463 7.98837 13.427L12.8787 18.3174C13.2693 18.7079 13.9024 18.7079 14.293 18.3174C14.6835 17.9269 14.6835 17.2937 14.293 16.9032L10.1073 12.7175C9.71678 12.327 9.71678 11.6939 10.1073 11.3033L14.2893 7.12129C14.6799 6.73077 14.6799 6.0976 14.2893 5.70708Z" fill="#0F0F0F"/>
            </svg>
            </button>
        </div>

        <!-- Next Button -->
        <div class="absolute right-4 top-1/2 -translate-y-1/2 flex justify-center" onclick="moveSlide(1)">
            <button class="bg-white p-3 rounded-full opacity-20 hover:opacity-100 duration-200 rotate-180">
            <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M14.2893 5.70708C13.8988 5.31655 13.2657 5.31655 12.8751 5.70708L7.98768 10.5993C7.20729 11.3805 7.2076 12.6463 7.98837 13.427L12.8787 18.3174C13.2693 18.7079 13.9024 18.7079 14.293 18.3174C14.6835 17.9269 14.6835 17.2937 14.293 16.9032L10.1073 12.7175C9.71678 12.327 9.71678 11.6939 10.1073 11.3033L14.2893 7.12129C14.6799 6.73077 14.6799 6.0976 14.2893 5.70708Z" fill="#0F0F0F"/>
            </svg>
            </button>
        </div>

        <!-- Indicator -->
        <div class="absolute bottom-0 w-full mb-8 ">
            <div class="w-full flex flex-row items-center justify-center">
                @for($pos = 1; $pos <= count($banner); $pos++)
                <div class="w-2.5 h-2.5 rounded-full mx-1 cursor-pointer dot" onclick="currenSlide({{$pos}})"></div>
                @endfor
            </div>
        </div>

    </div>

    <!-- Top 10 Movies Section -->
<div class="mt-12">
    <span class="ml-28 font-inter font-bold text-xl text-white">Top 10 Movies</span>

    <div class="w-auto flex flex-row overflow-x-auto pl-28 pt-6 pb-10">
        @foreach ($topMovies as $movieItem)

        @php
        // Cek dan format data movie
        $original_date = $movieItem->release_date;
        $timestamp = strtotime($original_date);
        $movieYear = date("Y", $timestamp);

        $movieID = $movieItem->id;
        $movieTitle = $movieItem->title;
        $movieRating = $movieItem->vote_average * 10;
        $movieImage = $movieItem->poster_path 
            ? "{$imageBaseURL}/w500{$movieItem->poster_path}" 
            : 'path/to/placeholder-image.jpg'; // URL untuk placeholder jika tidak ada gambar
        @endphp

        <a href="movie/{{$movieID}}" class="group">
            <div class="w-[232px] min-h-[428px] bg-gray-400 drop-shadow-[0_0px_8px_rgba(0,0,0,0.25)] group-hover:drop-shadow-[0,0px,8px_rgba(0,0,0,0.5)] rounded-[34px] p-5 flex flex-col mr-6 duration-100">
                <!-- Konten film di sini -->
                <div class="overflow-hidden rounded-[28px]">
                    <img src="{{$movieImage}}" class="w-full h-[300px] group-hover:scale-125 duration-200" alt="Poster {{$movieTitle}}" />
                </div>

                <span class="font-inter font-semibold text-xl mt-4 line-clamp-1 group-hover:line-clamp-none text-white">{{$movieTitle}}</span>
                <span class="font-inter text-sm mt-1 text-white">{{$movieYear}}</span>

                <div class="flex flex-row mt-1 items-center">
                    <svg width="24px" height="24px" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.9707 19.42V13.89" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M2.28234 12.67C2.25751 12.2167 2.32536 11.7631 2.48175 11.3369C2.63813 10.9106 2.87975 10.5208 3.19187 10.1911C3.504 9.86141 3.88006 9.59877 4.29708 9.41931C4.71411 9.23985 5.16335 9.14734 5.61735 9.14734C6.07135 9.14734 6.52058 9.23985 6.9376 9.41931C7.35463 9.59877 7.73069 9.86141 8.04281 10.1911C8.35493 10.5208 8.59657 10.9106 8.75296 11.3369C8.90934 11.7631 8.97717 12.2167 8.95234 12.67V18.3C8.97717 18.7533 8.90934 19.207 8.75296 19.6332C8.59657 20.0594 8.35493 20.4492 8.04281 20.7789C7.73069 21.1086 7.35463 21.3712 6.9376 21.5507C6.52058 21.7301 6.07135 21.8227 5.61735 21.8227C5.16335 21.8227 4.71411 21.7301 4.29708 21.5507C3.88006 21.3712 3.504 21.1086 3.19187 20.7789C2.87975 20.4492 2.63813 20.0594 2.48175 19.6332C2.32536 19.207 2.25751 18.7533 2.28234 18.3V12.67Z" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8.97076 18.3C8.96813 18.7399 9.05217 19.176 9.21809 19.5835C9.38402 19.9909 9.62857 20.3617 9.93779 20.6747C10.247 20.9876 10.6148 21.2366 11.0203 21.4073C11.4257 21.5781 11.8608 21.6674 12.3008 21.67H16.4208C17.3814 21.6693 18.316 21.357 19.0841 20.78C19.8522 20.203 20.4125 19.3924 20.6808 18.47L22.1808 13.39C22.3002 13.0523 22.3372 12.691 22.2889 12.3361C22.2405 11.9812 22.1081 11.643 21.9028 11.3496C21.6974 11.0562 21.4249 10.816 21.108 10.6491C20.7911 10.4822 20.4389 10.3934 20.0808 10.39H14.5608V5.10999C14.5621 4.91825 14.5256 4.72818 14.4535 4.55054C14.3813 4.3729 14.2749 4.21121 14.1402 4.07471C14.0056 3.9382 13.8454 3.82953 13.6687 3.75494C13.4921 3.68036 13.3025 3.64132 13.1108 3.64001V3.64001C12.7953 3.64144 12.4889 3.74572 12.2381 3.93701C11.9872 4.1283 11.8056 4.39617 11.7208 4.70001L8.97076 13.86" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="font-inter text-sm ml-1 text-white">{{$movieRating}}%</span>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>

<!-- Top 10 TV Show -->
<div class="mt-12">
    <span class="ml-28 font-inter font-bold text-xl text-white">Top 10 TV Shows</span>

    <div class="w-auto flex flex-row overflow-x-auto pl-28 pt-6 pb-10">
        @foreach ($topMovies as $movieItem)

        @php
        // Cek dan format data movie
        $original_date = $movieItem->release_date;
        $timestamp = strtotime($original_date);
        $movieYear = date("Y", $timestamp);

        $movieID = $movieItem->id;
        $movieTitle = $movieItem->title;
        $movieRating = $movieItem->vote_average * 10;
        $movieImage = $movieItem->poster_path 
            ? "{$imageBaseURL}/w500{$movieItem->poster_path}" 
            : 'path/to/placeholder-image.jpg'; // URL untuk placeholder jika tidak ada gambar
        @endphp

        <a href="movie/{{$movieID}}" class="group">
            <div class="w-[232px] min-h-[428px] bg-gray-400 drop-shadow-[0_0px_8px_rgba(0,0,0,0.25)] group-hover:drop-shadow-[0,0px,8px_rgba(0,0,0,0.5)] rounded-[34px] p-5 flex flex-col mr-6 duration-100">
                <!-- Konten film di sini -->
                <div class="overflow-hidden rounded-[28px]">
                    <img src="{{$movieImage}}" class="w-full h-[300px] group-hover:scale-125 duration-200" alt="Poster {{$movieTitle}}" />
                </div>

                <span class="font-inter font-semibold text-xl mt-4 line-clamp-1 group-hover:line-clamp-none text-white">{{$movieTitle}}</span>
                <span class="font-inter text-sm mt-1 text-white">{{$movieYear}}</span>

                <div class="flex flex-row mt-1 items-center">
                    <svg width="24px" height="24px" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.9707 19.42V13.89" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M2.28234 12.67C2.25751 12.2167 2.32536 11.7631 2.48175 11.3369C2.63813 10.9106 2.87975 10.5208 3.19187 10.1911C3.504 9.86141 3.88006 9.59877 4.29708 9.41931C4.71411 9.23985 5.16335 9.14734 5.61735 9.14734C6.07135 9.14734 6.52058 9.23985 6.9376 9.41931C7.35463 9.59877 7.73069 9.86141 8.04281 10.1911C8.35493 10.5208 8.59657 10.9106 8.75296 11.3369C8.90934 11.7631 8.97717 12.2167 8.95234 12.67V18.3C8.97717 18.7533 8.90934 19.207 8.75296 19.6332C8.59657 20.0594 8.35493 20.4492 8.04281 20.7789C7.73069 21.1086 7.35463 21.3712 6.9376 21.5507C6.52058 21.7301 6.07135 21.8227 5.61735 21.8227C5.16335 21.8227 4.71411 21.7301 4.29708 21.5507C3.88006 21.3712 3.504 21.1086 3.19187 20.7789C2.87975 20.4492 2.63813 20.0594 2.48175 19.6332C2.32536 19.207 2.25751 18.7533 2.28234 18.3V12.67Z" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8.97076 18.3C8.96813 18.7399 9.05217 19.176 9.21809 19.5835C9.38402 19.9909 9.62857 20.3617 9.93779 20.6747C10.247 20.9876 10.6148 21.2366 11.0203 21.4073C11.4257 21.5781 11.8608 21.6674 12.3008 21.67H16.4208C17.3814 21.6693 18.316 21.357 19.0841 20.78C19.8522 20.203 20.4125 19.3924 20.6808 18.47L22.1808 13.39C22.3002 13.0523 22.3372 12.691 22.2889 12.3361C22.2405 11.9812 22.1081 11.643 21.9028 11.3496C21.6974 11.0562 21.4249 10.816 21.108 10.6491C20.7911 10.4822 20.4389 10.3934 20.0808 10.39H14.5608V5.10999C14.5621 4.91825 14.5256 4.72818 14.4535 4.55054C14.3813 4.3729 14.2749 4.21121 14.1402 4.07471C14.0056 3.9382 13.8454 3.82953 13.6687 3.75494C13.4921 3.68036 13.3025 3.64132 13.1108 3.64001V3.64001C12.7953 3.64144 12.4889 3.74572 12.2381 3.93701C11.9872 4.1283 11.8056 4.39617 11.7208 4.70001L8.97076 13.86" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="font-inter text-sm ml-1 text-white">{{$movieRating}}%</span>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>

</div>

<script>
    let slideIndex = 1;
    showSlide(slideIndex);

    // Function to move to the next or previous slide
    function changeSlide(n) {
        showSlide(slideIndex += n);
    }

    // Display the current slide
    function showSlide(position) {
        let index;
        const slidesArray = document.getElementsByClassName("slide");
        const dotsArray = document.getElementsByClassName("dot");

        // Looping effect
        if (position > slidesArray.length) {
            slideIndex = 1;
        }
        if (position < 1) {
            slideIndex = slidesArray.length;
        }

        // Hide all slides
        for (index = 0; index < slidesArray.length; index++) {
            slidesArray[index].classList.add('hidden');
        }

        // Show active slide
        slidesArray[slideIndex - 1].classList.remove('hidden');

        // Remove active status from all dots
        for (index = 0; index < dotsArray.length; index++) {
            dotsArray[index].classList.remove('bg-jaki-500');
            dotsArray[index].classList.add('bg-white');
        }

        // Set active status for the current dot
        dotsArray[slideIndex - 1].classList.remove('bg-white');
        dotsArray[slideIndex - 1].classList.add('bg-jaki-500');
    }

    // Move slides based on step
    function moveSlide(moveStep) {
        showSlide(slideIndex += moveStep);
    }

    // Show a specific slide
    function currentSlide(position) {
        showSlide(slideIndex = position);
    }

    // Auto-slide every 2 seconds
    setInterval(() => {
        moveSlide(-1);
    }, 2000);
</script>

</body>
</html>