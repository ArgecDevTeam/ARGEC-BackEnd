// Secciones del blog
const blogEnglish = document.getElementById('english')
const blogSpanish = document.getElementById('spanish')
// Sacamos del localstorage el valor de lang
const storedLang = localStorage.getItem('lang')

const menuLang = document.querySelector('.lang-menu')

localStorage.setItem('lang', 'es-MX')

const botones = `      
  <div class='selected-lang'>
    <button onClick="establecerLenguaje('es-MX')">
      <img src="./assets/img/arg.png" alt='Bandera de Argentina' />
      ES
    </button>
  </div>
  <ul>
    <li>
      <button onClick="establecerLenguaje('en-US')">
        <img src="./assets/img/US.png" alt='Bandera de Estados Unidos' />
        EN
      </button>
    </li>
  </ul>`

const botonesEN = `      
  <div class='selected-lang'>
    <button onClick="establecerLenguaje('en-US')">
      <img src="./assets/img/US.png" alt='Bandera de Estados Unidos' />
      EN
    </button>
  </div>
  <ul>
    <li>
      <button onClick="establecerLenguaje('es-MX')">
        <img src="./assets/img/arg.png" alt='Bandera de Argentina' />
        ES
      </button>
    </li>
  </ul>`


function changeLanguage(lang) {
  if (lang === 'es-MX') {
    blogSpanish.style.display = 'flex'
    blogEnglish.style.display = 'none'
    menuLang.innerHTML = botones
  }
  if (lang === 'en-US') {
    blogEnglish.style.display = 'flex'
    blogSpanish.style.display = 'none'
    menuLang.innerHTML = botonesEN
  }
}

function establecerLenguaje(lang) {
  switch (lang) {
    case 'es-MX':
      changeLanguage('es-MX')
      localStorage.setItem('lang', 'es-MX')
      break
    case 'en-US':
      changeLanguage('en-US')
      localStorage.setItem('lang', 'en-US')
      break
    default:
      changeLanguage('es-MX')
  }
}

establecerLenguaje(storedLang)
