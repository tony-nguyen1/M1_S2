/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Beans/Bean.java to edit this template
 */
package fr.umontpellier.etu.switchapp.p1;

import javax.swing.JLabel;

/**
 *
 * @author tony.nguyen@etu.umontpellier.fr
 */
public class ZeroOuUn extends JLabel {
    
    public static final String PROP_SAMPLE_PROPERTY = "sampleProperty";
    
    
    public ZeroOuUn() {
        this.setText("zero");
    }
    
    public void switchText() {
        if (this.getText().equals("zero")) {
            this.setText("un");
        } else {
            this.setText("zero");
        }
    }
    
}
