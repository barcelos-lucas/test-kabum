document.addEventListener("DOMContentLoaded", function () {
  const telefoneInput = document.querySelector("input[name='telefone']");

  if (telefoneInput) {
      telefoneInput.addEventListener("input", function (e) {
          let valor = e.target.value.replace(/\D/g, ""); 

          if (valor.length > 11) {
              valor = valor.slice(0, 11); 
          }

          let telefoneFormatado = "";

          if (valor.length > 10) {
              telefoneFormatado = `(${valor.slice(0, 2)}) ${valor.slice(2, 7)}-${valor.slice(7, 11)}`;
          } else if (valor.length > 6) {
              telefoneFormatado = `(${valor.slice(0, 2)}) ${valor.slice(2, 6)}-${valor.slice(6, 10)}`;
          } else if (valor.length > 2) {
              telefoneFormatado = `(${valor.slice(0, 2)}) ${valor.slice(2)}`;
          } else if (valor.length > 0) {
              telefoneFormatado = `(${valor}`;
          }

          e.target.value = telefoneFormatado;
      });

      telefoneInput.addEventListener("keypress", function (e) {
          const charCode = e.which ? e.which : e.keyCode;
          if (charCode < 48 || charCode > 57) {
              e.preventDefault();
          }
      });
  }
});

    // tratamento CPF
    const cpfInput = document.querySelector("input[name='cpf']");
    if (cpfInput) {
        cpfInput.addEventListener("input", function (e) {
            let valor = e.target.value.replace(/\D/g, "");
            if (valor.length > 11) valor = valor.slice(0, 11);

            let cpfFormatado = "";
            if (valor.length > 9) {
                cpfFormatado = `${valor.slice(0, 3)}.${valor.slice(3, 6)}.${valor.slice(6, 9)}-${valor.slice(9, 11)}`;
            } else if (valor.length > 6) {
                cpfFormatado = `${valor.slice(0, 3)}.${valor.slice(3, 6)}.${valor.slice(6, 9)}`;
            } else if (valor.length > 3) {
                cpfFormatado = `${valor.slice(0, 3)}.${valor.slice(3, 6)}`;
            } else {
                cpfFormatado = valor;
            }

            e.target.value = cpfFormatado;
        });

        cpfInput.addEventListener("keypress", function (e) {
            const charCode = e.which ? e.which : e.keyCode;
            if (charCode < 48 || charCode > 57) e.preventDefault();
        });
    }

    document.addEventListener("DOMContentLoaded", function () {
      const rgInput = document.querySelector("input[name='rg']");
      if (rgInput) {
          rgInput.addEventListener("input", function (e) {
              let valor = e.target.value.replace(/[^a-zA-Z0-9]/g, ""); 
  
              if (valor.length > 12) {
                  valor = valor.slice(0, 12); 
              }
  
              e.target.value = valor;
          });
  
          rgInput.addEventListener("blur", function (e) {
              let valor = e.target.value;
  
              if (valor.length < 8 || valor.length > 12) {
                  alert("O RG deve ter entre 8 e 12 caracteres.");
                  e.target.value = "";
              }
          });
      }
  });


  document.addEventListener("DOMContentLoaded", function () {
    // tratamento CEP
    const cepInput = document.querySelector("input[name='cep']");
    if (cepInput) {
        cepInput.addEventListener("input", function (e) {
            let valor = e.target.value.replace(/\D/g, ""); 

            if (valor.length > 8) {
                valor = valor.slice(0, 8); 
            }

            let cepFormatado = "";
            if (valor.length > 5) {
                cepFormatado = `${valor.slice(0, 5)}-${valor.slice(5, 8)}`;
            } else {
                cepFormatado = valor;
            }

            e.target.value = cepFormatado;
        });

        cepInput.addEventListener("keypress", function (e) {
            const charCode = e.which ? e.which : e.keyCode;
            if (charCode < 48 || charCode > 57) e.preventDefault();
        });
    }
});
  