<?php $title="HMI - Hello!"; require("template.php"); ?>
<div id="enterBtnCon"><h1 id="enterBtn">A</h1></div>
<div id="bgObjCon">
  <div name="bgObj" class="bgObjBig" style="position: absolute; top: 69%; left: 10%; animation-fill-mode: backwards;">A</div>
  <div name="bgObj" class="bgObjBig" style="position: absolute; top: 11%; left: 34%;">A</div>
  <div name="bgObj" class="bgObjBig" style="position: absolute; top: 43%; left: 62%; animation-name: floatTwo;">A</div>
  <div name="bgObj" class="bgObjBig" style="position: absolute; top: 55%; left: 28%; animation-fill-mode: backwards;">G</div>
  <div name="bgObj" class="bgObjMed" style="position: absolute; top: 86%; left: 24%;">T</div>
  <div name="bgObj" class="bgObjMed" style="position: absolute; top: 29%; left: 44%; animation-name: floatTwo;">G</div>
  <div name="bgObj" class="bgObjMed" style="position: absolute; top: 11%; left: 22%; animation-name: floatTwo; animation-fill-mode: backwards;">G</div>
  <div name="bgObj" class="bgObjMed" style="position: absolute; top: 66%; left: 37%; animation-name: floatTwo;">T</div>
  <div name="bgObj" class="bgObjMed" style="position: absolute; top: 77%; left: 59%; animation-name: floatThree;">T</div>
  <div name="bgObj" class="bgObjMed" style="position: absolute; top: 58%; left: 23%; animation-name: floatFour; animation-fill-mode: backwards;">T</div>
  <div name="bgObj" class="bgObjSmall" style="position: absolute; top: 82%; left: 68%; animation-name: floatFour;">T</div>
  <div name="bgObj" class="bgObjSmall" style="position: absolute; top: 68%; left: 28%; animation-name: floatThree;">A</div>
  <div name="bgObj" class="bgObjSmall" style="position: absolute; top: 27%; left: 38%; animation-name: floatFour; animation-fill-mode: backwards;">A</div>
  <div name="bgObj" class="bgObjSmall" style="position: absolute; top: 60%; left: 67%; animation-name: floatThree;">A</div>
  <div name="bgObj" class="bgObjSmall" style="position: absolute; top: 89%; left: 60%; animation-name: floatFour;">T</div>
  <div name="bgObj" class="bgObjSmall" style="position: absolute; top: 75%; left: 57%; animation-name: floatThree; animation-fill-mode: backwards;">A</div>
  <div name="bgObj" class="bgObjBig" style="position: absolute; top: 12%; left: 70%; animation-name: floatTwo;">T</div>
  <div name="bgObj" class="bgObjBig" style="position: absolute; top: 38%; left: 80%;  animation-name: floatFour;">A</div>
  <div name="bgObj" class="bgObjMed" style="position: absolute; top: 11%; left: 76%; animation-name: floatTwo; animation-fill-mode: backwards;">C</div>
  <div name="bgObj" class="bgObjMed" style="position: absolute; top: 16%; left: 85%;">T</div>
  <div name="bgObj" class="bgObjSmall" style="position: absolute; top: 80%; left: 78%; animation-name: floatThree; animation-fill-mode: backwards;">C</div>
  <div name="bgObj" class="bgObjSmall" style="position: absolute; top: 40%; left: 10%; animation-name: floatThree; animation-fill-mode: backwards;">C</div>
</div>
<div id="menuCon">
  <div id="menuBar">
    <div id="menuTextCon">
      <a onclick="menuBtnClick('home')">HOME</a>
      <a onclick="menuBtnClick('tool')">TOOL</a>
      <a onclick="menuBtnClick('news')">NEWS</a>
      <a onclick="menuBtnClick('about')">ABOUT</a>
      <a onclick="menuBtnClick('forum')">FORUM</a>
    </div>
  </div>
  <div id="menuCard">
    
  </div>
</div>
<script src="entryScript.js"></script>
<script src="menuScript.js"></script>
