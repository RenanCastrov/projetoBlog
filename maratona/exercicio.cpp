#include <iostream>
 
using namespace std;
 
int main() {
 
    int senha = 2002;
    int dig;
    
    cin >> dig;
    if(dig == senha)
    {
        cout<<"Acesso Permitido"<<endl;
    }
    else
    {
        cout<<"Senha Inválida"<<endl;   
    }
 
    return 0;
}