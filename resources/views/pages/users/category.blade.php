@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <section class="">

        <div class=" mx-auto py-12 font-jost">
            <h1 class="text-4xl font-bold text-center mb-12 uppercase">Daftar Kategori</h1>

            <div class="space-y-8">
                <!-- Kategori 1 -->
                @foreach ($categories as $category)
                    <!-- Dynamic Category Cards -->
                    @include('components.categories.card_category', [
                        'path' => route('categories.show', $category->id_kategori_222405),
                        'title' => $category->nama_222405,
                        'isOdd' => $loop->iteration % 2 !== 1,
                        'desc' => $category->deskripsi_222405,
                        'image' => Str::startsWith($category->path_img_222405, 'http')
                            ? $category->path_img_222405
                            : asset('storage/' . $category->path_img_222405),
                    ])
                @endforeach

            </div>
        </div>

    </section>
@endsection
