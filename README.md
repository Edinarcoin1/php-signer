1. Скомпилировать PHP secp256k1 extension (ветка v0.0 для php5.6)
 
```
git clone https://github.com/Bit-Wasp/secp256k1-php.git
git clone https://github.com/bitcoin-core/secp256k1.git
cd secp256k1
./autogen.sh && ./configure --enable-experimental --enable-module-{ecdh,recovery} && make && sudo make install
cd ../secp256k1-php/secp256k1
git checkout v0.0 
phpize && ./configure --with-secp256k1 && make && sudo make install
```

2. Добавить `extension=secp256k1.so` в php.ini (размещение php.ini можно посмотреть в `phpinfo()`)
3. Убедиться, что в phpinfo появилось расширение `secp256k1`

Больше информации https://github.com/Bit-Wasp/secp256k1-php/tree/v0.0#verify-a-signature