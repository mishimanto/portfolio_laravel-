<x-layouts.app>
<style>
    body::before {
        background-image: url('{{ $siteSetting && $siteSetting->background_image ? asset("storage/images/" . $siteSetting->background_image) : "" }}');
        content: "";
        position: fixed;
        background-size: cover;
        left: 0;
        right: 0;
        top: 0;
        height: 100vh;
        z-index: -1;
    }

    .portfolio-details {
        padding: 40px 0;
        min-height: 100vh;
        background: rgba(0, 0, 0, 0.8);
    }

    .portfolio-details .portfolio-title {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 20px;
        color: #fff;
    }

    .portfolio-details .portfolio-info {
        background: rgba(255, 255, 255, 0.1);
        padding: 30px;
        border-radius: 10px;
    }

    .portfolio-details .portfolio-info h3 {
        font-size: 22px;
        font-weight: 400;
        margin-bottom: 20px;
        color: #18d26e;
    }

    .portfolio-details .portfolio-info ul {
        list-style: none;
        padding: 0;
        color: #fff;
    }

    .portfolio-details .portfolio-info ul li {
        padding: 10px 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .portfolio-details .portfolio-info ul li strong {
        width: 100px;
        display: inline-block;
        color: #18d26e;
    }

    .portfolio-details .portfolio-description {
        background: rgba(255, 255, 255, 0.1);
        padding: 30px;
        border-radius: 10px;
        margin-top: 30px;
        color: #fff;
    }

    .portfolio-details .portfolio-description h2 {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 20px;
        color: #18d26e;
    }

    .portfolio-details img {
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    .back-button {
        display: inline-block;
        padding: 10px 25px;
        background: linear-gradient(104deg, #3700ff, #ff0059);
        color: #fff;
        border-radius: 30px;
        margin-bottom: 20px;
        transition: transform 0.3s;
    }

    .back-button:hover {
        transform: translateX(-5px);
        color: #fff;
    }
</style>

<div class="portfolio-details">
    <div class="container mx-auto px-4">
        <a href="{{ url('/#portfolio') }}" class="back-button inline-flex items-center">
            <i class="bi bi-arrow-left mr-2"></i> Back to Portfolio
        </a>

        <div class="grid md:grid-cols-2 gap-8">
            <div>
                <img src="{{ asset('storage/images/' . $portfolio->image) }}" class="w-full rounded-lg shadow-lg" alt="{{ $portfolio->title }}">
            </div>

            <div class="portfolio-info">
                <h3 class="text-2xl font-bold text-[#18d26e] mb-4">Project Information</h3>
                <ul class="space-y-3">
                    <li><strong>Category:</strong> {{ $portfolio->category->name }}</li>
                    <li><strong>Client:</strong> {{ $portfolio->client ?? 'N/A' }}</li>
                    <li><strong>Project Date:</strong> {{ $portfolio->project_date ?? 'N/A' }}</li>
                    @if($portfolio->project_url)
                    <li><strong>Project URL:</strong> <a href="{{ $portfolio->project_url }}" target="_blank" class="text-[#18d26e] hover:underline">{{ $portfolio->project_url }}</a></li>
                    @endif
                </ul>
            </div>
        </div>

        <div class="portfolio-description mt-8">
            <h2 class="text-2xl font-bold text-[#18d26e] mb-4">{{ $portfolio->title }}</h2>
            <p class="text-gray-300 leading-relaxed">{{ $portfolio->description ?? 'No description available.' }}</p>
        </div>
    </div>
</div>

<script>
    // Smooth scroll to top on load
    window.scrollTo({ top: 0, behavior: 'smooth' });
</script>
</x-layouts.app>
