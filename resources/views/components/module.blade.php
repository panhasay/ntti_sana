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

    .ntti-effect-9 {
        position: relative;
        margin-bottom: 30px;
        overflow: hidden;
        height: 260px;
        box-shadow: 0 -1px 3px #959595
    }

    .ntti-effect-9 .effect-img {
        position: relative;
        font-size: 0;
        overflow: hidden
    }

    .ntti-effect-9 .effect-img img {
        position: relative;
        width: 100%;
        height: 200px;
        transition: .5s
    }

    .ntti-effect-9:hover .effect-img img {
        transform: scale(1.2)
    }

    .ntti-effect-9 .effect-text {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        padding: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        background: #0000001a;
        transition: .5s
    }

    .ntti-effect-9 .effect-text h2 {
        color: #fff;
        font-size: 25px;
        margin-bottom: 15px
    }

    .ntti-effect-9 .effect-text p {
        color: #222;
        font-size: 16px;
        padding: 0 30px;
        margin: 0;
        opacity: 0;
        transform: scale(0);
        transition: .5s;
        transition-delay: .2s
    }

    .ntti-effect-9:hover .effect-detail {
        width: 100%;
        height: calc(100% - 45px)
    }

    .ntti-effect-9:hover .effect-detail p {
        opacity: 1;
        transform: scale(1)
    }
</style>

<div {{ $attributes->merge(['class' => 'col-lg-2 col-md-2 col-sm-12']) }}>
    <div class="ntti-effect-9">
        <div class="effect-img position-relative">
            <img src="{{ $img }}" alt="{{ $title }}" class="img-fluid">
        </div>
        <div
            style="text-align: center !important;padding: 15px 10px 21px 10px;font-size: 13px;font-family: Khmer OS Battambang !important;font-weight: 900;">
            <span>{{ $title }}</span>
        </div>
        {{ $slot }}
    </div>
</div>
