<!DOCTYPE html>
<html>
<head>
<title>About</title>
<link rel="stylesheet" type="text/css" href="navmenu.css" />
</head>
<body>


<ul>
  <li><a href="home.php">Home</a></li>
  <li><a href="contact.php">Contact</a></li>
  <li><a href="about.php">About</a></li>
  <li><a href="jsandformual.html">Login</a></li>
  <li><a href="signup.php">Signup</a></li>
</ul>

<section id="about">
<b>SpeculAPP</b> este un joc Web care simuleaza operatiuni de specula valutara. <br> <br> <br>

Administratorul stabileste valutele (EUR, USD, GBP, etc.), 
marjele de randomizare a cursului, durata de valabilitate a cursului (in secunde), suma de inceput (in RON), pragul de castig (e.g., peste 2000 RON) 
si pragul de pierdere (de pilda, sub 100 RON). <br> <br> <br>

Jucatorul are la dispozitie doua seturi de comenzi: <br> <br>
<small>- <i><u><b>Afla curs pentru valuta V</b></u></i> (daca cursul generat anterior este mai vechi decat durata de valabilitate setata, 
va fi generat un nou curs; altfel va fi luat in considerare cel vechi)</small>
<br> <br>
<small>- <i><u><b>Schimba X unitati din valuta V in valuta W</b></u></i> (dupa fiecare operatiune de schimb valutar, se calculeaza valoarea totala a portofoliului jucatorului in RON; 
daca aceasta valoare e mai mica decat pragul de pierdere, jucatorul a pierdut jocul, iar daca e mai mare decat cel de castig, atunci a castigat jocul, 
altfel poate continua cu alte operatiuni)</small> <br> <br> <br>

Clasamentul celor mai "bogati" jucatori va fi generat dinamic si ca flux de stiri Atom sau drept raport disponibil in formatele HTML, JSON si PDF.
</section>

</body>
</html>