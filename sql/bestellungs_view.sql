CREATE OR REPLACE VIEW `bestellungsumsatz_view` AS
select kundeid,vorname,nachname,kundenbestellungsid,erstelldatum,gemahnt,kundenstatusid, (sum(verkaufspreis*anzahl)*(1-rabatt)) as umsatz
from kunde
join kundenbestellung using(kundeid)
join kundenstatus using(kundenstatusid)
join auftragsposition using(kundenbestellungsid)
join artikel using(artikelid);

CREATE OR REPLACE VIEW `auftragsposition_view` AS
select Kundenbestellungsid, artikelid,artikelname, verkaufspreis,anzahl, (verkaufspreis*anzahl) as gesamt
from auftragsposition
join artikel using(artikelid);

