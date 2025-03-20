@extends('layouts.app')

@section('content')

<style>
    .white-block {
    padding: 20px;
    border-radius: 8px;
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.categories-table-img img {
    width: 100%;
    height: 100%;
    border-radius: 8px;
}

.top-cat-list__title h3 {
    font-size: 18px;
    margin-bottom: 10px;
}

.top-cat-list__title p {
    font-size: 14px;
    color: #666;
}

.top-cat-list__subtitle {
    margin-top: 15px;
}
</style>

<div class="container">

    <h2>Catalogue des Burgers</h2>
      
    <div class="stat-cards-item" style="margin-top: 15px;">     

        <!-- ✅ Formulaire de filtrage -->
        <form action="{{ route('catalogue') }}" method="GET" class="mb-4 " style="justify-content: space-between; display: flex; gap: 15px;">
            {{-- <div class="row"> --}}
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Rechercher un burger..." value="{{ request('search') }}">
                </div>

                <div class="col-md-3">
                    <input type="number" name="min_price" class="form-control" placeholder="Prix min" value="{{ request('min_price') }}">
                </div>

                <div class="col-md-3">
                    <input type="number" name="max_price" class="form-control" placeholder="Prix max" value="{{ request('max_price') }}">
                </div>

                <div class="col-md-2">
                    <button type="submit" class="form-btn primary-default-btn transparent-btn">Filtrer</button>
                </div>
                
            {{-- </div> --}}
        </form>

    </div>



    <div class="row" style="margin-top: 2%">
        @foreach($burgers as $burger)
            <div class="col-md-4">
                <article class="white-block">
                    <div class="categories-table-img">
                        <picture>
                            <source srcset="{{ asset('storage/'.$burger->image) }}" type="image/webp">
                            <img src="{{ asset('storage/'.$burger->image) }}" alt="{{ $burger->nom }}">
                        </picture>
                    </div>
                    <div class="top-cat-list__title" style="display: block; text-align: center">
                        <h3>{{ $burger->nom }}</h3> 
                        <p>{{ $burger->description }}</p>
                        <p><strong>{{ $burger->prix }} F</strong></p>
                    </div>
                    <div class="top-cat-list__subtitle">
                        @if($burger->enStock())
                        <a href="{{ route('burgers.show', $burger->id) }}" class="form-btn primary-default-btn transparent-btn">
    Voir les détails
</a>

                        @else
                            <button class="form-btn secondary-default-btn transparent-btn" disabled>Rupture</button>
                        @endif
                    </div>
                </article>
            </div>
        @endforeach
    </div>

    
</div>
@endsection
