<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
        <url>
            <loc>{{route('home')}}</loc>
            <changefreq>hourly</changefreq>
            <priority>0.7</priority>
        </url>

    @foreach (App\Models\Category::all() as $entityCategory)
        <url>
            <loc>{{route('cat',['cat'=>$entityCategory->slug])}}</loc>
            <changefreq>always</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach

@foreach (App\Models\Entity::all() as $entity)
        <url>
            <loc>{{ route('ent',['ent'=>$entity->slug]) }}</loc>
            <lastmod>{{ $entity->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>hourly</changefreq>
            <priority>0.5</priority>
        </url>
    @endforeach
</urlset>

