#include <iostream>
#include <iomanip>

using namespace std;

int main() {
    double a[3][4] = {
        {2, 1, -1, 8},
        {-3, -1, 2, -11},
        {-2, 1, 2, -3}
    };

    int n = 3;

    // المرحلة الأولى: الحذف الأمامي (Forward Elimination)
    for (int i = 0; i < n; i++) {
        for (int k = i + 1; k < n; k++) {
            double factor = a[k][i] / a[i][i];
            for (int j = i; j <= n; j++) {
                a[k][j] -= factor * a[i][j];
            }
        }
    }

    double x[3];
    for (int i = n - 1; i >= 0; i--) {
        x[i] = a[i][n];
        for (int j = i + 1; j < n; j++) {
            x[i] -= a[i][j] * x[j];
        }
        x[i] /= a[i][i];
    }

    cout << "Results (Values of variables):" << endl;
    for (int i = 0; i < n; i++) {
        cout << "X" << i + 1 << " = " << fixed << setprecision(2) << x[i] << endl;
    }

    return 0;
}