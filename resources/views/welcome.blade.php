@extends('layouts.home')
@section('content')
<div class="container">
    <div class="px-2 py-3 my-5 text-center">
        <!-- Animation -->
        <div id="lottie-animation" style="width: 300px; height: 300px; margin-left: 180px;"></div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                lottie.loadAnimation({
                    container: document.getElementById('lottie-animation'), // the DOM element
                    renderer: 'svg', // the renderer
                    loop: true, // whether the animation should loop
                    autoplay: true, // whether the animation should start automatically
                    path: '{{ asset('animations/my-annimation.json') }}' // the path to the animation json
                });
            });
        </script>

        <h2 class="display-5 fw-bold mb-3">TRUCKFLOW</h2>
        <p class="lead mb-4">Bienvenue dans l'application de gestion de camions de livraison</p>

        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
        <a href="{{ route('loginagent') }}" class="btn btn-lg px-4 gap-3" style="color: #fff; background: #0299A7; border: 0; cursor: pointer;"         onmouseover="this.style.background='#027a85';"
        onmouseout="this.style.background='#0299A7';" aria-label="Se connecter en tant qu'agent">
                Agent
        </a>
            <!-- Bouton Admin -->
            <a href="{{ route('loginadmin') }}" class="btn btn-lg px-4 gap-3" style="color: #fff; background: #0299A7; border: 0; cursor: pointer;"         onmouseover="this.style.background='#027a85';"
            onmouseout="this.style.background='#0299A7';" aria-label="Se connecter en tant qu'administrateur">
                Admin
            </a>
        </div>
    </div>
</div>
@endsection
