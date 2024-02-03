/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package fr.umontpellier.etu.switchapp.p1;

import javax.swing.JLabel;

/**
 *
 * @author tony.nguyen@etu.umontpellier.fr
 */
public class AfficheurEntier extends JLabel {
    
    public void affiche(Integer i) {
        this.setText(String.valueOf(i));
    }
    
}
