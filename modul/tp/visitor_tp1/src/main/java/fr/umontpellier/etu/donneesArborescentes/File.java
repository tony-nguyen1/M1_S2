package fr.umontpellier.etu.donneesArborescentes;

public class File extends ElementStockage implements ICount, IConcatenate{
    private String contenu;
    protected static int size = 0;

    public int size() {
        return contenu.length();
    }

    public String absoluteAddress() {
        return null;//pwd
    }

    public void ls() {
        //print nom du fichier
    }

    public void cat() {
        System.out.println(contenu);
    }

    public int nbElem() {
        return contenu.length();
    }
}
