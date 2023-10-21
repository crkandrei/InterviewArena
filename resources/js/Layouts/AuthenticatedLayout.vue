<script setup>
import { ref } from 'vue';
import Navbar from '@/components/Navbar.vue';
</script>

<template>
    <div>
        <div class="min-h-screen bg-muddy-white ">
            <Navbar></Navbar>

            <!-- Page Content -->
            <main>
                <div>
                    <div class="left-shade">
                        <svg height="100%" id="Layer_2" data-name="Layer 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 264 800">
                            <g id="Layer_1-2" data-name="Layer 1">
                                <path class="cls-1" d="m.15,0s61.52,129.15,112.19,135.81,149.33,24,57.33,140C51,314.48,0,341.15,0,341.15L.15,0Z"/>
                                <path class="cls-2" d="m0,329.81s54.84-117.33,136.92-90.67,15.41,252,15.41,252L.15,485.81l-.15-156Z"/>
                                <path class="cls-3" d="m.15,431.81s78.85-42.67,205.52,117.33c113.2,142.99,25.47,175.01,24.7,175.23-2.76.77-5.26,1.44-7.37,2.1-25.33,8-48-28-68-28s-56.37-6.3-154.85,85.52v-352.19Z"/>
                            </g>
                        </svg>
                    </div>
                    <div class="right-shade">
                        <svg height="100%" id="Layer_2" data-name="Layer 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 264 800">

                            <g id="Layer_2-2" data-name="Layer 2">
                                <path class="cls-11" d="m351.65,102.49s-51.07-43.52-62.94-87.05c-11.87-43.52-83.09,16.82-95.95,35.61-12.86,18.79-133.54,182.01,0,283.89l158.88,31.65V102.49Z"/>
                                <path class="cls-21" d="m351.65,174.04s-124.26,2.97-152.45,86.06c-23.37,99.41,16.32,103.86-34.13,173.6-50.45,69.74-44.18,77.98-44.18,87.87s230.76,37.59,230.76,37.59V174.04Z"/>
                                <path class="cls-31" d="m351.65,556.52s-100.19-20.44-131.19-46.16S0,531.62,0,574.98s54.28,65.94,100.44,69.24,55.39,62.65,53.41,98.26c-1.98,35.61,45.42,63.97,197.79,41.54v-227.51Z"/>
                            </g>
                        </svg>
                    </div>
                </div>
                <slot />
            </main>
        </div>
    </div>
</template>
<style>
    @media (max-width: 1100px) {
        .left-shade,
        .right-shade {
            display: none;
        }
    }
    .left-shade{
        height: 90%;
        position: absolute;
        left: 0;
    }
    .right-shade{
        height: 90%;
        position: absolute;
        right: 0;
    }
    .cls-1 {
        fill: #3598f3;
    }

    .cls-2 {
        fill: #0e7bdf;
    }

    .cls-3 {
        fill: #0964b8;
    }
    .cls-11 {
        fill: #3598f3;
    }

    .cls-11, .cls-21, .cls-31 {
        isolation: isolate;
    }

    .cls-21 {
        fill: #0e7bdf;
    }

    .cls-31 {
        fill: #0964b8;
    }

</style>
