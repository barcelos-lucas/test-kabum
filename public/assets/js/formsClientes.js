$(document).ready(function(){
  $('#cpf').mask('000.000.000-00');
  $('#rg').mask('00.000.000-0');
  $('#telefone').mask('(00) 00000-0000');
  $('#cep').mask('00000-000');
});

function validarFormulario() {
  let cpf = document.getElementById('cpf').value;
  let rg = document.getElementById('rg').value;
  let telefone = document.getElementById('telefone').value;

  let regexCPF = /^\d{3}\.\d{3}\.\d{3}-\d{2}$/;
  let regexRG = /^\d{2}\.\d{3}\.\d{3}-\d$/;
  let regexTelefone = /^\(\d{2}\) \d{5}-\d{4}$/;

  if (!regexCPF.test(cpf)) {
      alert("CPF inválido! Use o formato: 123.456.789-00");
      return false;
  }

  if (!regexRG.test(rg)) {
      alert("RG inválido! Use o formato: 12.345.678-9");
      return false;
  }

  if (!regexTelefone.test(telefone)) {
      alert("Telefone inválido! Use o formato: (XX) XXXXX-XXXX");
      return false;
  }

  return true;
}
