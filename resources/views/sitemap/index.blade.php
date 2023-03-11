<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{route('home')}}</loc>
    </url>

    <url>
        <loc>{{route('about')}}</loc>
    </url>
    <url>
        <loc>{{route('privacy')}}</loc>
    </url>
    <url>
        <loc>{{route('terms')}}</loc>
    </url>

    @foreach (App\Models\Category::all() as $entityCategory)
        <url>
            <loc>{{route('cat',['cat'=>$entityCategory->slug])}}</loc>
        </url>
    @endforeach

    @foreach (App\Models\Entity::all() as $entity)
        <url>
            <loc>{{ route('ent',['ent'=>$entity->slug]) }}</loc>
        </url>
    @endforeach
</urlset>

