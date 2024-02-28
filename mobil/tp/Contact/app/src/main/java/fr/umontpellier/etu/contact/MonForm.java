package fr.umontpellier.etu.contact;

import android.app.Activity;
import android.os.Bundle;
import android.widget.TextView;

public class MonForm extends Activity {
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        TextView tv = new TextView(this);
        tv.setText("Hello, Android");
        tv = new TextView(this);
        tv.setText("Hello, Android");
        tv = new TextView(this);
        tv.setText("Hello, Android");
        setContentView(tv);
    }
}