SELECT 
a.id as id,
a.name as name,
a.description,a.price,a.cost_factor,
a.media_type,a.location,a.duration,
a.image_url,a.is_featured,a.meta_descriptor,
scat.name as 'sub category',
cat.name as 'category',
b.name as 'media house',
s.name as 'size',
t.name as 'type',
ap.name as 'appearance',
cur.name as 'currency'
from 
adsdirect.ad_slots a, 
adsdirect.media_houses b,
adsdirect.ad_slots_size s,
adsdirect.ad_slots_type t,
adsdirect.ad_slots_appearance ap,
adsdirect.ad_slots_currency cur,
adsdirect.sub_categories scat,
adsdirect.categories cat
WHERE
a.id=499
AND
b.id = a.media_house_id
AND
s.id=a.size_id
AND
t.id=a.type_id
AND
ap.id=a.appearance_id
AND
cur.id=a.currency_id
AND
scat.id=a.sub_cat_id
AND
cat.id=scat.cat_id