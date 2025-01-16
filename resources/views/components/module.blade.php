<style>
    .content-certificate {
        margin: auto;
        width: 100%;
    }

    .effect-img {
        position: relative;
        overflow: hidden;
    }

    .effect-img img {
        width: 100%;
        height: auto;
        object-fit: cover;
        border-radius: 0;
    }

    .title-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-family: 'Khmer M1', sans-serif;
        text-decoration: none;
        transition: opacity 0.3s ease-in-out;
    }

    .effect-img:hover .title-overlay:hover {
        opacity: 1;
        color: #fff;
    }
</style>

<div {{ $attributes->merge(['class' => 'col-lg-2 col-md-2 col-sm-12']) }}>
    <div class="effect-9">
        <div class="effect-img position-relative">
            <img src="{{ $img }}" alt="{{ $title }}" class="img-fluid rounded">
            <a href="{{ url($url) }}" class="title-overlay text-center">
                {{ $title }}
            </a>
        </div>
        <div class="title-department">
            <span>{{ $title }}</span>
        </div>
        {{ $slot }}
    </div>
</div>
