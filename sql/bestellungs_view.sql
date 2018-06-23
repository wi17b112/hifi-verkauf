CREATE OR REPLACE VIEW `bestellungsumsatz_view` AS
select kundeid,vorname,nachname,kundenbestellungsid,erstelldatum,gemahnt,kundenstatusid, (sum(verkaufspreis*anzahl)*(1-rabatt)) as umsatz
from kunde
join kundenbestellung using(kundeid)
join kundenstatus using(kundenstatusid)
join auftragsposition using(kundenbestellungsid)
join artikel using(artikelid)

select * from bestellungsumsatz_view
select * from kundenbestellung
select * from kundenstatus

select kundeid,vorname,nachname,kundenbestellungsid,sum(umsatz)
 from bestellungsumsatz_view where kundeid=$kid

