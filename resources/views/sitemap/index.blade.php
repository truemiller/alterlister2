<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{route('home')}}</loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    <url>
        <loc>{{route('about')}}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>{{route('privacy')}}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>{{route('terms')}}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>

    @foreach (App\Models\Category::all() as $entityCategory)
        <url>
            <loc>{{route('cat',['cat'=>$entityCategory->slug])}}</loc>
            <changefreq>daily</changefreq>
            <priority>0.9</priority>
        </url>
    @endforeach

    @foreach (App\Models\Entity::all() as $entity)
        <url>
            <loc>{{ route('ent',['ent'=>$entity->slug]) }}</loc>
            <lastmod>{{ $entity->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
</urlset>

