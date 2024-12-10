<!-- header.blade.php -->
<!-- Header -->
<div class="w-full bg-gray-800 h-[96px] drop-shadow-lg flex flex-row items-center">
    <div class="w-1/7 pl-5 pr-3">
        <p class="font-bold text-4xl font-quicksand text-white">TMN |</p>
    </div>
    <div class="w-1/3 flex items-center justify-start">
        <a href="/home" class="font-bold text-xs mr-3 text-white hover:text-jaki-500 duration-200 font-inter">Home</a>
        <a href="/movies" class="text-xs mr-3 text-white hover:text-jaki-500 duration-200 font-inter">Movies</a>
        <a href="/tv-shows" class="text-xs text-white hover:text-jaki-500 duration-200 font-inter">Tv Shows</a>
    </div>
    
    <div class="flex ml-auto pr-5 items-center">
        <div class="relative w-full max-w-xs">
            <input type="text" placeholder="Search..." class="w-full pr-10 pl-4 py-2 rounded-lg bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-jaki-500" />
            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                <svg width="20px" height="20px" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15.7955 15.8111L21 21M18 10.5C18 14.6421 14.6421 18 10.5 18C6.35786 18 3 14.6421 3 10.5C3 6.35786 6.35786 3 10.5 3C14.6421 3 18 6.35786 18 10.5Z" 
                        stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>
    </div>
</div>
