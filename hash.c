int hash(char* key) {
  int hash = 5381;
  for (int c = 0; key[c] != '\0'; c++)
        hash = ((hash << 5) + hash) + key[c];
    return hash;
}
