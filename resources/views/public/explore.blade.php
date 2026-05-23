@extends('layouts.sakn')

@section('title', 'محفظة مشاريعنا')

@section('styles')
<style>
    .portfolio-header {
        background: linear-gradient(rgba(20, 38, 28, 0.8), rgba(20, 38, 28, 0.8)), url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&q=80&w=2000') center/cover;
        padding: 100px 0;
        text-align: center;
        color: white;
    }

    .filter-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        padding: 30px;
        position: sticky;
        top: 100px;
    }

    .filter-title {
        color: var(--sakn-green, #2F4F3E);
        font-weight: 800;
        font-size: 1.2rem;
        margin-bottom: 25px;
        position: relative;
        padding-bottom: 15px;
    }

    .filter-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        right: 0;
        width: 50px;
        height: 3px;
        background: var(--sakn-gold, #BC9355);
    }

    .filter-label {
        font-weight: 700;
        color: var(--sakn-green, #2F4F3E);
        margin-bottom: 10px;
        display: block;
    }

    .filter-select {
        width: 100%;
        padding: 15px;
        border: 1px solid #eee;
        border-radius: 5px;
        background: #fcfcfc;
        outline: none;
        transition: border-color 0.3s;
    }

    .filter-select:focus {
        border-color: var(--sakn-gold, #BC9355);
    }

    .unit-card {
        background: white;
        border: none;
        border-radius: 0;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        transition: transform 0.4s, box-shadow 0.4s;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .unit-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }

    .unit-img {
        height: 280px;
        position: relative;
        overflow: hidden;
    }

    .unit-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.7s;
    }

    .unit-card:hover .unit-img img {
        transform: scale(1.1);
    }

    .unit-status {
        position: absolute;
        top: 20px;
        right: 20px;
        background: var(--sakn-gold, #BC9355);
        color: white;
        padding: 8px 20px;
        font-weight: bold;
        font-size: 0.85rem;
        letter-spacing: 1px;
    }

    .unit-body {
        padding: 30px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .unit-price {
        color: var(--sakn-gold, #BC9355);
        font-weight: 900;
        font-size: 1.6rem;
        margin-bottom: 15px;
    }

    .unit-title {
        font-size: 1.3rem;
        font-weight: 800;
        color: var(--sakn-green, #2F4F3E);
        margin-bottom: 15px;
    }

    .unit-location {
        color: #666;
        margin-bottom: 25px;
    }

    .unit-meta {
        display: flex;
        gap: 20px;
        border-top: 1px solid #f1f1f1;
        padding-top: 20px;
        margin-top: auto;
    }

    .unit-meta span {
        font-weight: 600;
        color: #555;
    }

    .unit-meta i {
        color: var(--sakn-gold, #BC9355);
        margin-left: 5px;
    }
</style>
@endsection

@section('content')
    <!-- Page Header -->
    <header class="portfolio-header">
        <div class="container">
            <h1 style="font-size: 3.5rem; font-weight: 900; margin-bottom: 20px;">محفظة مشاريعنا</h1>
            <p style="font-size: 1.2rem; max-width: 600px; margin: 0 auto; color: #e0d8c3;">نقدم لك مجموعة مختارة من أحدث وأرقى مشاريعنا السكنية والتجارية، مصممة بعناية لتعكس أعلى معايير الجودة.</p>
        </div>
    </header>

    <section class="section" style="background-color: #fcfcfc;">
        <div class="container">
            <div style="display: flex; gap: 40px; flex-wrap: wrap;">
                
                <!-- Filters Sidebar -->
                <aside style="width: 100%; max-width: 320px; flex-shrink: 0;">
                    <div class="filter-card">
                        <h3 class="filter-title">تصفية الوحدات</h3>
                        
                        <form action="{{ route('explore') }}" method="GET">
                            <div style="margin-bottom: 25px;">
                                <label class="filter-label">البحث السريع</label>
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="ابحث عن مشروع أو وحدة..." class="filter-select">
                            </div>

                            <div style="margin-bottom: 25px;">
                                <label class="filter-label">حالة المشروع</label>
                                <select class="filter-select" name="status">
                                    <option value="">جميع المشاريع</option>
                                    <option value="under_construction">قيد الإنشاء</option>
                                    <option value="completed">مكتمل وجاهز للتسليم</option>
                                    <option value="sold_out">مباع بالكامل</option>
                                </select>
                            </div>

                            <div style="margin-bottom: 25px;">
                                <label class="filter-label">نوع الوحدة</label>
                                <select class="filter-select" name="type">
                                    <option value="">جميع الوحدات</option>
                                    <option value="villa">فيلا سكنية</option>
                                    <option value="apartment">شقة فاخرة</option>
                                    <option value="commercial">مكتب تجاري</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 15px; background: var(--sakn-gold, #BC9355); font-size: 1.1rem;">عرض النتائج</button>
                            
                            @if(request()->anyFilled(['search', 'status', 'type']))
                                <a href="{{ route('explore') }}" style="display: block; text-align: center; margin-top: 15px; color: #888; font-size: 14px; text-decoration: underline;">إعادة ضبط</a>
                            @endif
                        </form>
                    </div>
                </aside>

                <!-- Results Area -->
                <div style="flex: 1; min-width: 0;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px; border-bottom: 2px solid #eee; padding-bottom: 20px;">
                        <p style="font-size: 1.1rem; color: #555;">نعرض لك <strong>{{ $properties->total() }}</strong> وحدة متاحة ضمن مشاريعنا</p>
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 30px;">
                        @forelse($properties as $property)
                            <div class="unit-card">
                                <div class="unit-img">
                                    @if($property->images->where('is_main', true)->first())
                                        <img src="{{ asset('storage/' . $property->images->where('is_main', true)->first()->url) }}" alt="{{ $property->title }}">
                                    @else
                                        <img src="https://images.unsplash.com/photo-1580587771525-78b9dba3b914?auto=format&fit=crop&q=80&w=600" alt="Fallback">
                                    @endif
                                    <div class="unit-status">{{ strtoupper($property->status) }}</div>
                                </div>
                                <div class="unit-body">
                                    <div class="unit-price">{{ number_format($property->price) }} ريال</div>
                                    <h3 class="unit-title">{{ $property->title }}</h3>
                                    <p class="unit-location"><i class="bi bi-geo-alt-fill" style="color: var(--sakn-gold, #BC9355);"></i> {{ $property->city }}، {{ $property->district }}</p>
                                    
                                    <div class="unit-meta">
                                        <span><i class="bi bi-arrows-fullscreen"></i> {{ $property->area ?? 250 }} م²</span>
                                        <span><i class="bi bi-door-open"></i> {{ $property->rooms ?? 4 }} غرف</span>
                                    </div>
                                    
                                    <a href="#" class="btn btn-outline" style="width: 100%; margin-top: 25px; text-align: center; border-color: var(--sakn-green, #2F4F3E); color: var(--sakn-green, #2F4F3E);">طلب عرض سعر</a>
                                </div>
                            </div>
                        @empty
                            <div style="grid-column: 1 / -1; text-align: center; padding: 80px 20px; background: white; border-radius: 8px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
                                <i class="bi bi-building-x" style="font-size: 60px; color: #ddd; margin-bottom: 20px; display: block;"></i>
                                <h3 style="color: var(--sakn-green, #2F4F3E); margin-bottom: 15px;">لا توجد وحدات مطابقة</h3>
                                <p style="color: #777; margin-bottom: 30px;">لم نتمكن من العثور على وحدات ضمن مشاريعنا تتطابق مع معايير البحث الخاصة بك.</p>
                                <a href="{{ route('explore') }}" class="btn btn-primary" style="background: var(--sakn-gold, #BC9355);">استكشف كافة المشاريع</a>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div style="margin-top: 60px;">
                        {{ $properties->links() }}
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
