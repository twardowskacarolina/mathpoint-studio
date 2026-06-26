# Handoff: MathPoint Studio — Landing Page

## Overview
Jednostronicowa strona (landing page) dla studia korepetycji z matematyki **MathPoint Studio** (działalność: *Lucidus*), prowadzonego przez **Marię Jodłowską**. Celem strony jest pozyskiwanie zgłoszeń (leadów) od **rodziców** uczniów szkół podstawowych i średnich oraz od maturzystów. Strona prezentuje ofertę, sylwetkę właścicielki, wyróżniki, kameralne warsztaty, opinie oraz sekcję kontaktu z **działającym formularzem zgłoszeniowym** i **interaktywnym kalendarzem wolnych terminów**.

Język strony: **polski** (jednojęzyczna).

---

## About the Design Files
Pliki w tej paczce to **referencja projektowa wykonana w HTML** — prototyp pokazujący docelowy wygląd i zachowanie, **nie** kod produkcyjny do skopiowania 1:1.

Zadaniem jest **odtworzenie tego projektu w docelowym środowisku/kodzie** (np. Next.js/React, Astro, Vue, WordPress itp.) z użyciem ustalonych w nim wzorców, bibliotek i systemu komponentów. Jeśli środowisko jeszcze nie istnieje, należy dobrać najwłaściwszy framework dla strony marketingowej (rekomendacja: statyczny generator typu **Astro** lub **Next.js** ze statycznym eksportem — strona jest w większości statyczna, z dwoma wyspami interaktywności: formularz + kalendarz).

Plik `MathPoint Studio.dc.html` jest tzw. „Design Component" — używa autorskiego runtime'u (`support.js`) ze składnią szablonów (`{{ }}`, `<sc-for>`, `<sc-if>`) oraz klasą logiki w JS. **Nie przenoś tego runtime'u do produkcji** — potraktuj go jako specyfikację: HTML → markup/komponenty, klasa `Component` → logika stanu, style inline → CSS/tokeny.

### Jak czytać plik źródłowy
- **Sekcja `<helmet>`** (góra) — `<title>`, meta description, **meta keywords (SEO)**, Open Graph, oraz **JSON-LD `EducationalOrganization`** (schema.org). To przenieś do `<head>` produkcyjnej strony.
- **Szablon** — markup sekcji ze stylami inline.
- **Klasa `Component`** (na dole pliku) — cała logika: stan kalendarza, walidacja formularza, dane opinii, listy.

---

## Fidelity
**High-fidelity (hifi).** Finalne kolory, typografia, odstępy i interakcje. UI należy odtworzyć pikselowo wiernie, używając bibliotek i wzorców docelowego repo. Placeholdery zdjęć (patrz *Assets*) są celowe — klientka dośle realne fotografie.

---

## Design Tokens

### Kolory (brand)
| Token | Hex | Użycie |
|---|---|---|
| Primary blue | `#1A6281` | nagłówki, przyciski główne, logotyp tekstowy, footer (`#15536E` = ciemniejszy wariant gradientu) |
| Accent violet | `#9F86BC` | akcenty, ikony, podkreślenia, tryb edycji kalendarza, elementy „odręczne" (`#7C64A0` / `#8A6FAE` = ciemniejsze warianty) |
| Beż/sage | `#D5D6BC` | bazowy kolor dopełniający marki |
| Background main | `#FBFBF6` | główne tło strony (jasne, ciepłe) |
| Background alt | `#EEEFE2` | tło sekcji naprzemiennych (Oferta, Kontakt) |
| Card sage tint | `#F4F5EA` border `#E6E7D6` | jasne karty (Co zyskujesz, O mnie) |
| Card violet tint | `#F4F0F8` border `#E7DEF0` | karty z akcentem fioletowym (dyskalkulia, certyfikaty) |
| Text default | `#2B3A40` | tekst podstawowy |
| Text muted | `#56636A` / `#7B8680` | tekst drugorzędny |
| Border light | `#E8E9DA` / `#E2E3D2` | obramowania, linie |
| Star rating | `#E8B84B` | gwiazdki opinii |
| Error | `#C25B5B` | komunikaty walidacji |

Dozwolone delikatne gradienty na bazie powyższych:
- Hero tło: `radial-gradient(130% 120% at 82% -10%, #E7E9D7 0%, #F3F4E9 42%, #FBFBF6 72%)`
- Pasek statystyk / karta kontaktu: `linear-gradient(135deg, #1A6281, #15536E)`
- Baner warsztatów: `linear-gradient(135deg, #9F86BC 0%, #8A6FAE 55%, #7C64A0 100%)`

### Typografia
- **Nagłówki / liczby / logotyp**: `Space Grotesk` (400/500/600/700), `letter-spacing: -.02em` do `-.035em` na dużych nagłówkach.
- **Tekst / body / UI**: `DM Sans` (400/500/600/700).
- **Akcenty odręczne** (np. „matematyka to mój język od zawsze", podpis): `Caveat` (600/700) — kolor `#9F86BC`.
- Import: Google Fonts.
- Skala nagłówków używa `clamp()`: H1 hero `clamp(42px, 6.2vw, 74px)`, H2 sekcji `clamp(30px, 4vw, 42px)`, lead `clamp(19px, 2.4vw, 24px)`.
- Etykiety nadsekcji (eyebrow): 13px, weight 700, `letter-spacing:.12em`, `text-transform:uppercase`, kolor `#9F86BC`.

### Odstępy i kształty
- Padding pionowy sekcji: **96px** (góra/dół), hero `74px/90px`, baner `90px`.
- Max szerokość kontentu: **1180px**, padding boczny **24px**.
- Border-radius: przyciski pill `999px`, karty `20–22px`, mniejsze karty/inputy `11–18px`, logo `12–18px`.
- Cienie: karty `0 6px 20px rgba(26,98,129,.05)`, uniesione `0 10px 30px rgba(26,98,129,.07)`, CTA `0 8px 22px rgba(26,98,129,.28)`, baner warsztatów `0 18px 40px rgba(91,68,124,.3)`.
- Siatki: wszystkie sekcje używają `display:grid; grid-template-columns:repeat(auto-fit,minmax(Npx,1fr)); gap:20–26px` — w pełni responsywne bez media queries.

---

## Screens / Views
Strona to jeden przewijany widok. Nawigacja kotwicowa (`#hero`, `#o-mnie`, `#oferta`, `#warsztaty`, `#opinie`, `#kontakt`) z płynnym scrollem (`scroll-behavior:smooth`).

### 1. Nav (sticky)
- `position:sticky; top:0; z-index:60`, tło `rgba(251,251,246,.86)` + `backdrop-filter:blur(14px)`, dolna linia `#E8E9DA`.
- Lewo: logo (44×44, `border-radius:12px`) + tekst „MathPoint Studio" (Space Grotesk 700, 18px; „Studio" w kolorze `#9F86BC`).
- Prawo: linki (O mnie, Oferta, Warsztaty, Opinie) 15px/500 `#43525A` + CTA pill „Darmowa konsultacja" (tło `#1A6281`, biały tekst).

### 2. Hero (`#hero`)
- Tło: radial gradient (patrz tokeny). Dekoracyjne symbole matematyczne (`÷ π √ +`) pozycjonowane absolutnie, `opacity .06–.12`, animacja `floaty` (unoszenie ±18px, 7–10s, `ease-in-out infinite`).
- Layout: `flex; flex-wrap:wrap; gap:52px; align-items:center`. Lewa kolumna `flex:1 1 460px`, prawa `flex:1 1 360px`.
- Lewa: badge pill („Korepetycje z matematyki · Maria Jodłowska") → H1 **„Matematyka z pasji."** („z pasji." fioletowe) → lead **„Zrozum zamiast wkuwać — spokój dla Ciebie, jasność dla Twojego dziecka."** (z fioletowym podkreśleniem pod „spokój dla Ciebie") → akapit wprowadzający przełamujący lęk → dwa CTA: „Umów darmową konsultację" (pełny niebieski) i „📞 794 050 245" (outline, `href="tel:+48794050245"`) → adnotacja o bezpłatnej konsultacji 15–30 min.
- Prawa: placeholder zdjęcia (aspect 4:5, biała ramka 6px, radius 28px) + odznaka „10+ lat / doświadczenia" (fioletowa, obrócona -4°, lewy-dolny róg) + odręczny napis „studio ✕" (Caveat, prawy-górny róg).

### 3. Pasek statystyk
- Tło: niebieski gradient, tekst biały. `grid auto-fit minmax(180px,1fr)`, 4 pozycje wyśrodkowane: **10+** lat doświadczenia · **2000+** przeprowadzonych godzin · **do 4** osób w grupie warsztatowej · **100%** indywidualne podejście.
- ⚠️ Liczby `2000+` i `do 4` to **propozycje** — do potwierdzenia z klientką.

### 4. O mnie (`#o-mnie`)
- `grid auto-fit minmax(300px,1fr); gap:56px`. Lewo: placeholder zdjęcia (aspect 5:6, biała ramka) + dekoracyjny znak „=". Prawo: eyebrow „O mnie" → H2 **„Cześć, jestem Maria Jodłowska"** → podtytuł Caveat „matematyka to mój język od zawsze" → 2 akapity (10+ lat doświadczenia, autorski system bez wkuwania) → 2 karty: 🎓 **Wykształcenie** (UJ — matematyka w ekonomii lic., ekonomia/rachunkowość mgr) i 📜 **Szkolenia i certyfikaty** („Matematyka intuicyjna" w trakcie, praca z dyskalkulią) → chipy: Jasność przekazu, Cierpliwość, Rzetelność, Indywidualne podejście.

### 5. Oferta / Dla kogo (`#oferta`)
- Tło `#EEEFE2`. Eyebrow „Dla kogo" → H2 „Komu pomagam i na jakim etapie" → akapit (materiał wg rozporządzeń CKE).
- 4 białe karty (`grid auto-fit minmax(250px,1fr)`), każda: ikona-kafelek 48×48 (symbol Space Grotesk), mała etykieta fioletowa, H3, opis:
  1. **Szkoła podstawowa** (klasy 4–7, symbol `+`) — budowanie fundamentów.
  2. **Ósmoklasiści** (egzamin CKE, symbol `8`) — przygotowanie do egzaminu.
  3. **Szkoła średnia** (klasy przedmaturalne, symbol `√`) — bieżący materiał.
  4. **Maturzyści** (podstawa i rozszerzenie, symbol `∑`, kafelek fioletowy) — strategia + arkusze CKE.

### 6. Co zyskujesz?
- Eyebrow + H2 „Jak wyglądają zajęcia i co dostajesz w cenie". 6 kart (`auto-fit minmax(260px,1fr)`), tło `#F4F5EA` (karta dyskalkulii `#F4F0F8`):
  - ⏱️ **Lekcja 60 minut**
  - 🎁 **Darmowa konsultacja** (15–30 min, stacjonarnie/Google Meet)
  - 💻 **Stacjonarnie, online lub hybrydowo** (Google Meet + tablet graficzny + Miro; siedziba bez dojazdów)
  - 🧩 **Wsparcie przy dyskalkulii** — *wyłącznie stacjonarnie* (wyróżnione)
  - 💬 **Stały kontakt na WhatsApp** w cenie (pomoc z pracami domowymi w tygodniu)
  - 📈 **Realne postępy**

### 7. Warsztaty (baner, `#warsztaty`)
- Tło: fioletowy gradient, tekst biały, wielki dekoracyjny `×` (`opacity .07`). Badge „★ KAMERALNE WARSZTATY" → H2 „Ucz się w małej grupie — w lepszej cenie" → akapit. 3 karty:
  1. **Warsztaty maturalne i dla 8-klasistów** (biała karta, badge „NAJCHĘTNIEJ WYBIERANE") — max 4 osoby, online, arkusze CKE, dwa poziomy. Tagi: max 4 osoby / online / niższa cena.
  2. **Warsztaty tabliczki mnożenia** (biała karta) — klasy 3–4 SP, nauka przez zabawę.
  3. **Warsztaty dla najmłodszych 5–10 lat** (karta przezroczysta z przerywaną ramką, badge „WKRÓTCE · WAKACJE") — matematyka wizualna i intuicyjna.
- CTA pod kartami: „Zapytaj o wolne miejsca" (biały przycisk, fioletowy tekst).

### 8. Opinie (`#opinie`)
- Eyebrow + H2 „Co mówią uczniowie i rodzice" + odznaka „5,0 ★★★★★". 8 kart (`auto-fit minmax(280px,1fr)`): 5 gwiazdek, cytat, awatar z inicjałem (koło 42×42, fiolet) + imię + rola.
- Osoby: **Iwona, Maria, Lena, Wiktoria, Ola, Zofia, Mariola, Oliwia**. ⚠️ Treść cytatów to **propozycje** — zastąpić autentycznymi opiniami.

### 9. Kontakt (`#kontakt`)
- Tło `#EEEFE2`. Eyebrow + H2 „Umówmy się na zajęcia" + akapit (wybór terminu + cennik mailowo). `grid auto-fit minmax(320px,1fr); gap:26px`:
  - **Lewo: Formularz** (patrz niżej).
  - **Prawo: Kalendarz** (patrz niżej) + **karta kontaktu** (niebieski gradient): 📞 794 050 245 (`tel:`), ✉️ kontakt@mathpoint-studio.com (`mailto:`), 💬 WhatsApp „stały kontakt w cenie", oraz nota o cenniku wysyłanym mailowo.

### 10. Footer
- Tło `#15536E`, tekst biały. Logo (`assets/logo-dark.svg`, 96×96) + slogan + podpis Caveat „Maria Jodłowska". Kolumny: Strona (linki kotwicowe), Kontakt (telefon, e-mail, tryby). Dół: „© 2026 MathPoint Studio · Lucidus — Maria Jodłowska" + „Obowiązuje Regulamin".

---

## Interactions & Behavior

### Nawigacja
- Linki kotwicowe + globalne `scroll-behavior:smooth`.

### Hero — animacja
- Keyframe `floaty`: `translateY(0)→-18px→0`, z zachowaniem indywidualnego `rotate` (CSS var `--r`). Czasy 7–10s na symbol, `ease-in-out infinite`.

### Formularz zgłoszeniowy (działający, walidacja po stronie klienta)
Pola: **Imię** (tekst), **Telefon lub e-mail** (tekst), **Etap nauki** (select), **Forma zajęć** (segmented: Stacjonarnie / Online / Hybrydowo — domyślnie „Stacjonarnie"), **Wiadomość** (textarea, opcjonalna). Pod spodem panel „Wybrany termin: …" (synchronizowany z kalendarzem).

Reguły walidacji (na submit):
- `name` — wymagane (po `trim`). Błąd: „Podaj imię."
- `contact` — wymagane. Poprawne, jeśli **e-mail** (`/^[^\s@]+@[^\s@]+\.[^\s@]+$/`) **lub** zawiera **≥ 9 cyfr** (telefon). Błędy: pusty → „Podaj telefon lub e-mail."; niepoprawny → „Podaj poprawny numer telefonu lub adres e-mail."
- `level` — wymagane (select ≠ pusty). Błąd: „Wybierz etap nauki."
- Komunikaty błędów: czerwone (`#C25B5B`), 12.5px, pod polem.

Po poprawnym submit: formularz znika, pojawia się **ekran sukcesu** (zielony/fioletowy znak ✓, „Dziękuję za zgłoszenie!", potwierdzenie wybranego terminu). **Brak wysyłki na serwer** — w produkcji podłączyć do endpointu / usługi mailowej (np. formspree, własny API route, lub e-mail kontakt@mathpoint-studio.com).

Opcje selecta „Etap nauki": Szkoła podstawowa (kl. 4–7), Ósmoklasista, Szkoła średnia, Matura podstawowa, Matura rozszerzona, Warsztaty grupowe, Inne.

### Kalendarz wolnych terminów (interaktywny)
- Siatka: kolumna godzin (46px) + 6 dni (**Pon, Wt, Śr, Czw, Pt, Sob**) × 5 slotów godzinowych (**15:00, 16:00, 17:00, 18:00, 19:00**).
- Stany komórki:
  - **wolne** — tło `#EDE6F5`, obrys `1.5px solid #CBB9E2`, tekst „wolne", klikalne (tryb klienta).
  - **wybrane** — tło `#9F86BC`, biały „✓", cień; ustawia `form.term` i tekst w formularzu.
  - **zajęte** — tło `#F1F2E8`, szary „·", nieklikalne w trybie klienta.
- **Tryb klienta**: klik wolnego slotu → wybór terminu (synchronizacja z formularzem, tekst „Wybrany termin: …").
- **Tryb edycji** (przycisk „Edytuj wolne godziny" / „✓ Tryb edycji"): klik dowolnej komórki przełącza wolne↔zajęte. W tym trybie zajęte pokazują „+" z przerywanym obrysem.
- **Trwałość**: stan slotów zapisywany w `localStorage` pod kluczem `mathpoint_slots` (JSON mapy `"Dzień HH:MM": true`). Odczyt przy starcie, fallback do `seed`.
- Legenda pod kalendarzem: wolne / wybrane / zajęte.
- Domyślne wolne sloty (seed): Pon 16/17, Wt 15/18, Śr 17/19, Czw 16/18, Pt 15/16, Sob 15.
- **W produkcji — WAŻNE: kalendarz ma być połączony z [TidyCal](https://tidycal.com).** Klientka chce zarządzać terminami w TidyCal, a na stronie pokazywać **tylko wolne godziny** i umożliwiać rezerwację. Sposób wdrożenia:
  - Zalecane: osadzić oficjalny **widget rezerwacji TidyCal** (embed / iframe z linku „Booking page" w panelu TidyCal) w miejscu kalendarza w sekcji Kontakt — wtedy synchronizacja dostępności i rezerwacje obsługuje TidyCal.
  - Alternatywnie, jeśli wymagany jest własny, brandowany wygląd kalendarza (jak w prototypie): pobierać wolne terminy z **TidyCal API** i tworzyć rezerwacje przez API, zachowując styl z prototypu. Wymaga klucza API/konta TidyCal klientki.
  - Model pozostaje ten sam co w prototypie: „tylko wolne godziny widoczne dla klienta", a edycję dostępności robi właścicielka **po stronie TidyCal** (nie w localStorage — to było tylko na potrzeby prototypu).
  - Po rezerwacji/zgłoszeniu zachować potwierdzenie wybranego terminu w formularzu (lub oprzeć cały przepływ rezerwacji na TidyCal i potraktować formularz jako dodatkowe zgłoszenie).

---

## State Management
Cały stan w jednym komponencie (referencyjnie klasa `Component`):
- `slots` — mapa `{ "Pon 16:00": true, ... }` wolnych terminów (z `localStorage` **tylko w prototypie**; w produkcji źródłem dostępności jest **TidyCal** — patrz sekcja Kalendarz).
- `editMode` — bool, tryb edycji kalendarza.
- `selected` — string, wybrany termin (np. „Wt 18:00").
- `form` — `{ name, contact, level, mode, msg, term }`.
- `errors` — `{ name?, contact?, level? }`.
- `submitted` — bool, przełącza formularz ↔ ekran sukcesu.

Tweaki (przełączniki widoczności sekcji, opcjonalne w produkcji): `showStats`, `showCalendar`, `showWorkshops` — wszystkie domyślnie `true`.

Transitions:
- Klik komórki kalendarza → aktualizacja `slots` (edit) lub `selected`+`form.term` (klient) → persist.
- Zmiana pól → aktualizacja `form`.
- Submit → walidacja → `errors` lub `submitted=true`.

---

## Assets
W folderze `assets/`:
- `logo-light.jpg` — logo na jasnym tle (używane w nav).
- `logo-dark.jpg` — logo na ciemnym tle (wariant).
- `logo-dark.svg` — logo wektorowe (używane w footerze, 96×96). **Preferuj SVG** w produkcji.
- `maria-ig.png` — przykładowa grafika z Instagrama (referencja, nieużywana bezpośrednio w layoucie).

**Placeholdery zdjęć** (do podmiany przez klientkę):
- Hero — portret Marii, proporcje **4:5**.
- O mnie — Maria przy pracy, proporcje **5:6**.
Placeholdery to paski `repeating-linear-gradient(45deg, #E4E6D4, #DADCC8)` z opisem — w produkcji wstawić realne, zoptymalizowane zdjęcia (z `alt` i `loading="lazy"`).

Ikony: obecnie **emoji** (⏱️ 🎁 💻 🧩 💬 📈 📝 ✖️ 🎨 📞 ✉️ 💬). W produkcji można zastąpić zestawem ikon SVG (np. Lucide) w kolorach marki — zachowaj znaczenie.

---

## SEO (ważne — grupa docelowa: rodzice)
Strona jest przygotowana pod SEO; przenieś do produkcji:
- `<title>`: „MathPoint Studio — Korepetycje z matematyki | Maria Jodłowska"
- `meta description` i `meta keywords` (m.in.: korepetycje z matematyki, przygotowanie do matury, egzamin ósmoklasisty, korepetycje online, dyskalkulia, warsztaty maturalne).
- Open Graph (`og:title`, `og:description`, `og:type`).
- **JSON-LD `EducationalOrganization`** (schema.org) z danymi: nazwa, founder, telefon `+48794050245`, e-mail, slogan.
- W produkcji dodaj: realny `og:image`, `canonical`, `sitemap.xml`, `robots.txt`, oraz adres siedziby w schema (gdy znany — wzmocni lokalne SEO).
- Semantyka: jeden `<h1>` (hero), `<h2>` na sekcje, `<nav>`, `<header>`, `<section>`, `<footer>`, opisowe `alt`.

---

## Files
- `MathPoint Studio.dc.html` — kompletny prototyp (markup + style inline + logika + meta/SEO). Główne źródło prawdy.
- `support.js` — runtime prototypu (**tylko do podglądu lokalnego; nie wdrażać**).
- `assets/` — logo i materiały (patrz wyżic *Assets*).

### Jak podejrzeć prototyp lokalnie
Otwórz `MathPoint Studio.dc.html` przez serwer statyczny (np. `npx serve` w tym folderze) — wymaga obecności `support.js` i `assets/` obok pliku. Otwarcie przez `file://` może blokować ładowanie zasobów.

---

## Dane kontaktowe / firmowe (do użycia w implementacji)
- Nazwa: **MathPoint Studio** (działalność: *Lucidus*)
- Właścicielka: **Maria Jodłowska**
- Telefon: **794 050 245** (`+48794050245`)
- E-mail: **kontakt@mathpoint-studio.com**
- Slogan: „Matematyka z pasji. Zrozum zamiast wkuwać — spokój dla Ciebie, jasność dla Twojego dziecka."
- Cennik: wysyłany **mailowo** po kontakcie (nie publikować stawek na stronie).
- Tryby zajęć: stacjonarnie (siedziba), online (Google Meet + tablet graficzny + Miro), hybrydowo. Dyskalkulia: **wyłącznie stacjonarnie**.
