## Należy utworzyć klucze za pomocą
### Generowanie klucza prywatnego
<code>openssl genrsa -des3 -out private.pem 4096</code>
### Generowanie klucza publicznego
<code>openssl rsa -in private.pem -outform PEM -pubout -out public.pem</code>
## Nadać uprawnienia do odczytu
<code>chmod 644 private.pem</code><br>
<code>chmod 644 public.pem</code>