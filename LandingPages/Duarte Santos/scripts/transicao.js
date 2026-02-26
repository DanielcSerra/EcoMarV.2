const configuracaoFaq = {
    threshold: [0.3, 0.5, 0.7, 1],
    rootMargin: '-10% 0px -10% 0px'
};

const configuracaoFormulario = {
    threshold: [0.3, 0.5, 0.7, 1],
    rootMargin: '-10% 0px -10% 0px'
};

const observadorFaq = new IntersectionObserver((entradas) => {
    entradas.forEach(entrada => {
        const elemento = entrada.target;
        const visibilidade = entrada.intersectionRatio;
        if (entrada.isIntersecting && visibilidade > 0.3) {
            elemento.classList.add('visivel');
            elemento.classList.remove('oculto');
            elemento.style.opacity = 1;
        } else {
            elemento.classList.remove('visivel');
            elemento.classList.add('oculto');
            elemento.style.opacity = 0;
        }
    });
}, configuracaoFaq);

const observadorFormulario = new IntersectionObserver((entradas) => {
    entradas.forEach(entrada => {
        const formulario = entrada.target;
        const visibilidade = entrada.intersectionRatio;
        if (entrada.isIntersecting && visibilidade > 0.3) {
            formulario.classList.add('visivel');
            formulario.classList.remove('oculto');
            formulario.style.opacity = 1;
        } else {
            formulario.classList.remove('visivel');
            formulario.classList.add('oculto');
            formulario.style.opacity = 0;
        }
    });
}, configuracaoFormulario);

function controlarMusica() {
    const secoes = document.querySelectorAll('section');
    const alturaTela = window.innerHeight;
    secoes.forEach(secao => {
        const limites = secao.getBoundingClientRect();
        const noCentro = limites.top < alturaTela / 2 && limites.bottom > alturaTela / 2;
        const musica = document.getElementById('bg' + secao.id);
        if (musica) {
            if (noCentro) {
                musica.volume = 0.1;
                musica.play();
            } else {
                musica.pause();
                musica.currentTime = 0;
            }
        }
    });
}

window.addEventListener('scroll', () => {
    const secaoFaq = document.getElementById('faq');
    const secaoFormulario = document.getElementById('formulario');
    const elementosFaq = document.querySelectorAll('.esquerda, .meio, .direita');
    const areaFaq = secaoFaq.getBoundingClientRect();
    const alturaTela = window.innerHeight;
    const alturaVisivelFaq = Math.min(areaFaq.bottom, alturaTela) - Math.max(areaFaq.top, 0);
    const visibilidadeFaq = Math.min(alturaVisivelFaq / alturaTela, 1);
    elementosFaq.forEach(elemento => {
        if (visibilidadeFaq > 0.3) {
            elemento.classList.add('visivel');
            elemento.classList.remove('oculto');
            elemento.style.opacity = 1;
        } else {
            elemento.classList.remove('visivel');
            elemento.classList.add('oculto');
            elemento.style.opacity = 0;
        }
    });
    const formulario = document.querySelector('#formulario form');
    const areaFormulario = secaoFormulario.getBoundingClientRect();
    const alturaVisivelForm = Math.min(areaFormulario.bottom, alturaTela) - Math.max(areaFormulario.top, 0);
    const visibilidadeForm = Math.min(alturaVisivelForm / alturaTela, 1);
    if (visibilidadeForm > 0.3) {
        formulario.classList.add('visivel');
        formulario.classList.remove('oculto');
        formulario.style.opacity = 1;
    } else {
        formulario.classList.remove('visivel');
        formulario.classList.add('oculto');
        formulario.style.opacity = 0;
    }
    controlarMusica();
});

document.addEventListener('DOMContentLoaded', () => {
    const secoesFaq = document.querySelectorAll('.esquerda, .meio, .direita');
    secoesFaq.forEach(secao => observadorFaq.observe(secao));
    const formulario = document.querySelector('#formulario form');
    observadorFormulario.observe(formulario);
    controlarMusica();
});

document.getElementById('botao').addEventListener('click', e => {
    e.preventDefault();
    document.getElementById('formulario').scrollIntoView({ behavior: 'smooth' });
});

document.addEventListener('DOMContentLoaded', function() {
    const formulario = document.querySelector('form');
    function emailValido(email) {
        const formato = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return formato.test(email);
    }
    function telefoneValido(telefone) {
        const formato = /^9[1236]\d{7}$/;
        return formato.test(telefone.replace(/\s/g, ''));
    }
    function idadeValida(idade) {
        return idade >= 16 && idade <= 100;
    }
    function nomeValido(nome) {
        return nome.length >= 2 && /^[a-zA-ZÀ-ÿ\s]+$/.test(nome);
    }
    formulario.addEventListener('submit', function(e) {
        e.preventDefault();
        const primeiroNome = document.getElementById('pnome').value;
        const ultimoNome = document.getElementById('lnome').value;
        const email = document.getElementById('email').value;
        const telefone = document.getElementById('telefone').value;
        const idade = document.getElementById('idade').value;
        let erros = [];
        if (!nomeValido(primeiroNome)) erros.push('O nome precisa ter pelo menos 2 letras');
        if (!nomeValido(ultimoNome)) erros.push('O sobrenome precisa ter pelo menos 2 letras');
        if (!emailValido(email)) erros.push('Email inválido');
        if (!telefoneValido(telefone)) erros.push('Telefone inválido (formato: 912 345 678)');
        if (!idadeValida(parseInt(idade))) erros.push('Idade deve ser entre 16 e 100 anos');
        if (erros.length > 0) alert('Erros no formulário:\n' + erros.join('\n'));
        else {
            alert('Formulário enviado com sucesso! Obrigado pelo teu interesse.');
            formulario.reset();
        }
    });
    const campoTelefone = document.getElementById('telefone');
    campoTelefone.addEventListener('input', function(e) {
        let numero = e.target.value.replace(/\D/g, '');
        if (numero.length > 0) numero = numero.replace(/^(\d{3})(\d{3})(\d{3})$/, '$1 $2 $3');
        e.target.value = numero;
    });
    const campoIdade = document.getElementById('idade');
    campoIdade.addEventListener('input', function(e) {
        if (e.target.value < 0) e.target.value = 0;
    });
});

let isSnapping = false;
let timeout;

window.addEventListener('scroll', () => {
    if (isSnapping) return;
    clearTimeout(timeout);
    timeout = setTimeout(() => {
        const sections = Array.from(document.querySelectorAll('section'));
        const scrollPos = window.scrollY + window.innerHeight / 2;
        let closest = sections[0];
        let closestDist = Math.abs(scrollPos - sections[0].offsetTop - window.innerHeight / 2);
        sections.forEach(sec => {
            const dist = Math.abs(scrollPos - sec.offsetTop - window.innerHeight / 2);
            if (dist < closestDist) {
                closest = sec;
                closestDist = dist;
            }
        });
        isSnapping = true;
        closest.scrollIntoView({ behavior: 'smooth' });
        setTimeout(() => isSnapping = false, 800);
    }, 150);
});
