#include <iostream>
 
using namespace std;
 
int main() {
 
    float A,B,C;
    
    float delta = ((B*B) - (4*A*C));
    if(delta < 0)
	{
		cout << "Impossivel calcular";
	}
	else
	{
		if(delta == 0)
		{
			float x1 = (-B + sqrt(delta))/(2*A);
			float x2 = (-B - sqrt(delta))/(2*A);
		}
	}
}
