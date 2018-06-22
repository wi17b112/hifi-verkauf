CREATE OR REPLACE VIEW `bestellungsumsatz_view` AS
select kundeid,kundenbestellungsid,erstelldatum,gemahnt,kundenstatusid, (sum(verkaufspreis*anzahl)*(1-rabatt)) as umsatz
from kunde
join kundenbestellung using(kundeid)
join kundenstatus using(kundenstatusid)
join auftragsposition using(kundenbestellungsid)
join artikel using(artikelid)
group by kundenbestellungsid

select * from bestellungsumsatz_view